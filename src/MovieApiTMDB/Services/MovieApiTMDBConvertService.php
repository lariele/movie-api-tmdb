<?php

namespace Lariele\MovieApiTMDB\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Lariele\Movie\Models\Movie;
use Lariele\Movie\Services\MovieConvertHelperService;
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

        Log::channel('convert')->debug('Converted data ', [$movieData]);

        $movie = Movie::query()->create($movieData);

        $this->movieConvertHelper = (new MovieConvertHelperService($movie));

        $movie->data()->create([
            'release_date' => strlen($tmdbMovie->release_date) > 0 ? $tmdbMovie->release_date : null,
            'duration' => $tmdbMovie->data->runtime,
        ]);

        $this->convertMovieCreators($movie, $tmdbMovie);

        $this->convertMovieCategories($tmdbMovie);

        $this->convertMovieTags($tmdbMovie);

        $this->convertMovieCountries($tmdbMovie);

        $this->convertMoviePoster($tmdbMovie);

        $this->convertMovieProviders($tmdbMovie);

        $tmdbMovie->update([
            'processed_at' => Carbon::now(),
        ]);


        return $movie;
    }

    /**
     * Creators
     */
    public function convertMovieCreators(Movie $movie, TMDBMovie $tmdbMovie)
    {
        $actors = $tmdbMovie->data->credits['cast'] ? collect($tmdbMovie->data->credits['cast'])->pluck('name') : null;

        $this->movieConvertHelper->setCreators($movie->actress(), $actors);

        //$this->movieConvertHelper->setCreators($movie->directors(), $actors);
        return;

//        $this->helper->setCreators($this->movie->directors(), $this->botItem->data->directors);
//
//        $this->helper->setCreators($this->movie->artwork(), $this->botItem->data->artwork);
//
//        $this->helper->setCreators($this->movie->script(), $this->botItem->data->script);
//
//        $this->helper->setCreators($this->movie->camera(), $this->botItem->data->camera);
//
//        $this->helper->setCreators($this->movie->music(), $this->botItem->data->music);
//
//        $this->helper->setCreators($this->movie->producers(), $this->botItem->data->producers);
//
//        $this->helper->setCreators($this->movie->edit(), $this->botItem->data->edit);
//
//        $this->helper->setCreators($this->movie->production(), $this->botItem->data->production);
//
//        $this->helper->setCreators($this->movie->costumes(), $this->botItem->data->costumes);
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
     * Creators
     */
    public function convertMovieCountries(TMDBMovie $tmdbMovie)
    {
        $countries = $tmdbMovie->data->production_countries ? collect($tmdbMovie->data->production_countries)->pluck('name') : null;

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
            $this->movieConvertHelper->setPoster('https://image.tmdb.org/t/p/original/' . $tmdbMovie->data->poster_path);
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

            foreach ($tmdbMovie->providers->results as $country) {
                if (!empty($country)) {
                    if (!empty($country['flatrate'])) {
                        foreach ($country['flatrate'] as $provider) {
                            $addProviders[] = $provider['provider_name'];
                        }
                    }
                }
            }

            if (!empty($addProviders)) {
                $this->movieConvertHelper->setProviders($addProviders);
            }
        }
    }
}
