<?php

namespace Lariele\MovieApiTMDB\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Lariele\Movie\Models\Movie;
use Lariele\Movie\Services\MovieConvertHelperService;
use Lariele\MovieApiTMDB\Models\TMDBMovie;

class MovieApiTMDBConvertService
{
    public function __construct(private MovieConvertHelperService $movieConvertHelper)
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
        $movieData['year'] = $tmdbMovie->release_date->year;

        Log::channel('convert')->debug('Converted data ', [$movieData]);

        $movie = Movie::query()->create($movieData);

        $movie->data()->create([
            'release_date' => $tmdbMovie->release_date,
            'duration' => $tmdbMovie->data->runtime,
        ]);

        $this->convertMovieCreators($movie, $tmdbMovie);

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
        /**
         * Actress
         */
        $this->movieConvertHelper->setCreators($movie->actress(), [0 => 'Tester']);


        exit();
        /**
         * Directors
         */
        $this->helper->setCreators($this->movie->directors(), $this->botItem->data->directors);

        /**
         * Artwork
         */
        $this->helper->setCreators($this->movie->artwork(), $this->botItem->data->artwork);

        /**
         * Script
         */
        $this->helper->setCreators($this->movie->script(), $this->botItem->data->script);

        /**
         * Camera
         */
        $this->helper->setCreators($this->movie->camera(), $this->botItem->data->camera);

        /**
         * Music
         */
        $this->helper->setCreators($this->movie->music(), $this->botItem->data->music);

        /**
         * Producers
         */
        $this->helper->setCreators($this->movie->producers(), $this->botItem->data->producers);

        /**
         * Edit
         */
        $this->helper->setCreators($this->movie->edit(), $this->botItem->data->edit);

        /**
         * Production
         */
        $this->helper->setCreators($this->movie->production(), $this->botItem->data->production);

        /**
         * Costumes
         */
        $this->helper->setCreators($this->movie->costumes(), $this->botItem->data->costumes);
    }
}
