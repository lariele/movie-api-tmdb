<?php

namespace Lariele\MovieApiTMDB\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use App\SFD\Movie\Models\Movie;
use App\SFD\Movie\Services\MovieConvertHelperService;
use Lariele\MovieApiTMDB\Models\TMDBMovie;

class MovieApiTMDBConvertService
{
    private MovieConvertHelperService $movieConvertHelper;

    public function __construct()
    {
        //
    }

    /**
     * Convert TMDB movie to Lariele Movie data
     *
     * @param TMDBMovie $tmdbMovie
     * @return array
     */
    public function convertMovie(TMDBMovie $tmdbMovie)
    {
        $movieData['name'] = $tmdbMovie->title;
        $movieData['year'] = $tmdbMovie->release_date ? $tmdbMovie->release_date->year : null;
        $movieData['rating'] = $tmdbMovie->data->vote_average ?? null;

        Log::channel('convert')->debug('Converted data ', [$movieData]);

        $movie = Movie::query()->create($movieData);

        $this->movieConvertHelper = (new MovieConvertHelperService($movie));

        $this->convertMovieData($tmdbMovie);

        $this->convertMovieDescriptions($tmdbMovie);

        $this->convertMovieTranslations($movie, $tmdbMovie);

        $this->convertMovieCreators($movie, $tmdbMovie);

        $this->convertMovieCategories($tmdbMovie);

        $this->convertMovieTags($tmdbMovie);

        $this->convertMovieCountries($tmdbMovie);

        $this->convertMoviePoster($tmdbMovie);
        $this->convertMovieBackdrop($tmdbMovie);

        $this->convertMovieProviders($tmdbMovie);

        $this->convertMovieExternals($tmdbMovie);

        $this->convertMovieVideos($tmdbMovie);

        $tmdbMovie->update([
            'processed_at' => Carbon::now(),
        ]);


        return $movie;
    }

    /**
     * Movie Data
     *
     * @param TMDBMovie $tmdbMovie
     * @return void
     */
    public function convertMovieData(TMDBMovie $tmdbMovie)
    {
        $data = [
            'released_at' => strlen($tmdbMovie->release_date) > 0 ? $tmdbMovie->release_date : null,
            'duration' => $tmdbMovie->data->runtime,
        ];

        $this->movieConvertHelper->setData($data);
    }

//    /**
//     * Movie Data
//     *
//     * @param TMDBMovie $tmdbMovie
//     * @return void
//     */
    public function convertMovieDescriptions(TMDBMovie $tmdbMovie): void
    {
        if (!empty($tmdbMovie->data->overview)) {
            $description = [
                'description' => $tmdbMovie->data->overview,
                'type' => 'def',
                'lang' => config('movie.description.lang.en')
            ];

            $this->movieConvertHelper->setDescription($description);
        }

        if (!empty($tmdbMovie->data->tagline)) {
            $description = [
                'description' => $tmdbMovie->data->tagline,
                'type' => 'short',
                'lang' => config('movie.description.lang.en')
            ];

            $this->movieConvertHelper->setDescription($description);
        }
    }

    /**
     * Movie Data
     *
     * @param Movie $movie
     * @param string $name
     * @param int $lang
     * @return void
     */
    public function convertMovieTranslationName(Movie $movie, string $name, int $lang): void
    {
        $movie->names()->create(['name' => $name, 'lang' => $lang]);
    }

    /**
     * Movie Data
     *
     * @param Movie $movie
     * @param TMDBMovie $tmdbMovie
     * @param string $lang
     * @return void
     */
    public function convertMovieTranslations(Movie $movie, TMDBMovie $tmdbMovie, $lang = 'sk'): void
    {
        $langId = config('movie.description.lang.' . $lang);

        $translationsByLang = collect($tmdbMovie->translations['results']['translations'])->keyBy('iso_639_1')->toArray(
        );

        if (isset($translationsByLang[$lang])) {
            $translation = $translationsByLang[$lang];

            if (!empty($translation['data']['title']) && strlen($translation['data']['title']) > 1) {
                if ($lang === config('movie.app.lang.default')) {
                    $movie->update(['name' => $translation['data']['title']]);
                }

                $this->convertMovieTranslationName($movie, $translation['data']['title'], $langId);
            }

            if (!empty($translation['data']['overview']) && strlen($translation['data']['overview']) > 1) {
                $description = [
                    'description' => $translation['data']['overview'],
                    'type' => 'def',
                    'lang' => $langId,
                ];

                $this->movieConvertHelper->setDescription($description);
            }

            if (!empty($translation['data']['tagline']) && strlen($translation['data']['tagline']) > 1) {
                $description = [
                    'description' => $translation['data']['tagline'],
                    'type' => 'short',
                    'lang' => $langId,
                ];

                $this->movieConvertHelper->setDescription($description);
            }
        }
    }

    /**
     * Creators
     */
    public function convertMovieCreators(Movie $movie, TMDBMovie $tmdbMovie)
    {
        $cast = $tmdbMovie->credits['results']['cast'] ?? null;
        $crew = $tmdbMovie->credits['results']['crew'] ?? null;

        //$credits = $tmdbMovie->data->credits['cast'] ? collect($tmdbMovie->data->credits['cast'])->pluck('name') : null;

        // known_for_department Acting
        $actors = $cast ? collect($cast)->where('known_for_department', '=', 'Acting')->pluck('name') : null;
        $this->movieConvertHelper->setCreators($movie->actress(), $actors);

        // known_for_department Director
        $directors = $crew ? collect($crew)->where('job', '=', 'Director')->pluck('name') : null;
        $this->movieConvertHelper->setCreators($movie->directors(), $directors);

        // known_for_department Music
        $music = $crew ? collect($crew)->where('known_for_department', '=', 'Camera')->pluck('name') : null;
        $this->movieConvertHelper->setCreators($movie->camera(), $music);

        // known_for_department Sound
        $sound = $crew ? collect($crew)->where('known_for_department', '=', 'Sound')->pluck('name') : null;
        $this->movieConvertHelper->setCreators($movie->music(), $sound);

        // known_for_department Edit
        $edit = $crew ? collect($crew)->where('job', '=', 'Editor')->pluck('name') : null;
        $this->movieConvertHelper->setCreators($movie->edit(), $edit);

        // Writing
        $writing = $crew ? collect($crew)->where('job', '=', 'Writer')->pluck('name') : null;
        $this->movieConvertHelper->setCreators($movie->script(), $writing);

        // known_for_department Costume
        $costume = $crew ? collect($crew)->where('known_for_department', '=', 'Costume')->pluck('name') : null;
        $this->movieConvertHelper->setCreators($movie->costumes(), $costume);

        // Costume & Make-Up
        $makeUp = $crew ? collect($crew)->where('known_for_department', '=', 'Costume & Make-Up')->pluck('name') : null;
        $this->movieConvertHelper->setCreators($movie->costumes(), $makeUp);

        // Producer
        $producers = $crew ? collect($crew)->where('job', '=', 'Producer')->pluck('name') : null;
        $this->movieConvertHelper->setCreators($movie->producers(), $producers);

        // known_for_department Production
        $production = $crew ? collect($crew)->where('known_for_department', '=', 'Production')->pluck('name') : null;
        $this->movieConvertHelper->setCreators($movie->production(), $production);
    }

    /**
     * Movie Categories
     *
     * @param TMDBMovie $tmdbMovie
     * @return void
     */
    public function convertMovieCategories(TMDBMovie $tmdbMovie)
    {
        $categories = $tmdbMovie->data->genres ? collect($tmdbMovie->data->genres)->pluck('name') : null;

        $this->movieConvertHelper->setCategories($categories);
    }

    /**
     * Movie Tags
     *
     * @param TMDBMovie $tmdbMovie
     * @return void
     */
    public function convertMovieTags(TMDBMovie $tmdbMovie)
    {
        $tags = $tmdbMovie->data->keywords ? collect($tmdbMovie->data->keywords['keywords'])->pluck('name') : null;

        $this->movieConvertHelper->setTags($tags);
    }

    /**
     * Countries
     */
    public function convertMovieCountries(TMDBMovie $tmdbMovie)
    {
        $countries = $tmdbMovie->data->production_countries ? collect($tmdbMovie->data->production_countries)->pluck(
            'name'
        ) : null;

        $this->movieConvertHelper->setCountries($countries);
    }

    /**
     * Movie Poster
     *
     * @param TMDBMovie $tmdbMovie
     * @return void
     */
    public function convertMoviePoster(TMDBMovie $tmdbMovie)
    {
        if (!empty($tmdbMovie->data->poster_path)) {
            $this->movieConvertHelper->setPoster(
                'https://image.tmdb.org/t/p/original/' . $tmdbMovie->data->poster_path
            );
        }
    }

    /**
     * Movie Backdrop
     *
     * @param TMDBMovie $tmdbMovie
     * @return void
     */
    public function convertMovieBackdrop(TMDBMovie $tmdbMovie)
    {
        if (!empty($tmdbMovie->data->backdrop_path)) {
            $this->movieConvertHelper->setBackdrop(
                'https://image.tmdb.org/t/p/original/' . $tmdbMovie->data->backdrop_path
            );
        }
    }

    /**
     * Watch Providers
     *
     * @param TMDBMovie $tmdbMovie
     * @return void
     */
    public function convertMovieProviders(TMDBMovie $tmdbMovie)
    {
        if (!empty($tmdbMovie->providers) && !empty($tmdbMovie->providers->results)) {
            foreach ($tmdbMovie->providers->results as $lang => $country) {

                if (isset(config('movie.provider.lang')[strtolower($lang)])) {
                    Log::debug($lang);
                    if (!empty($country)) {
                        if (!empty($country['flatrate'])) {
                            foreach ($country['flatrate'] as $provider) {
                                $addProviders[] = [
                                    'name' => $provider['provider_name'],
                                    'lang' => config('movie.provider.lang.' . strtolower($lang)),
                                ];
                            }
                        }
                    }
                }
            }

            if (!empty($addProviders)) {
                Log::debug('add prov',[$addProviders]);
                $this->movieConvertHelper->setProviders($addProviders);
            }
        }
    }

    /**
     * External
     */
    public function convertMovieExternals(TMDBMovie $tmdbMovie)
    {
        $external = [
            'type' => 'tmdb',
            'external_id' => $tmdbMovie->tmdb_id,
            'name' => $tmdbMovie->title,
        ];

        $externals[] = $external;

        $external = [
            'type' => 'imdb',
            'external_id' => $tmdbMovie->imdb_id,
        ];

        $externals[] = $external;

        $this->movieConvertHelper->setExternals($externals);
    }

    /**
     * Videos
     */
    public function convertMovieVideos(TMDBMovie $tmdbMovie)
    {
        $tmdbVideos = collect($tmdbMovie->data->videos['results']);

        $videos = null;

        foreach ($tmdbVideos as $tmdbVideo) {
            if ($tmdbVideo['site'] == 'YouTube') {
                $video = [
                    'name' => $tmdbVideo['name'],
                    'url' => $tmdbVideo['key'],
                    'active' => true,
                    'type' => $tmdbVideo['type']
                ];

                $videos[] = $video;
            }
        }

        $this->movieConvertHelper->setVideos($videos);
    }
}
