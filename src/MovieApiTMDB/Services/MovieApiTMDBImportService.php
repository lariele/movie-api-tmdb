<?php

namespace Lariele\MovieApiTMDB\Services;

use Illuminate\Support\Facades\Log;
use Lariele\MovieApiMDBL\Events\Created as MDBLCreated;
use Lariele\MovieApiTMDB\API\MovieTMDBApi;
use Lariele\MovieApiTMDB\Events\Created;
use Lariele\MovieApiTMDB\Events\Discovered;
use Lariele\MovieApiTMDB\Models\TMDBMovie;
use Lariele\MovieApiTMDB\Models\TMDBMovieDiscover;

class MovieApiTMDBImportService
{
    public function __construct(private MovieTMDBApi $movieApi)
    {
        //
    }

    public function getMovie($movieToCheck)
    {
        Log::channel('import')->debug('Get TMDB movie ' . $movieToCheck);

        $movie = $this->movieApi->getMovie($movieToCheck);

        if (!isset($movie['title'])) {
            Log::channel('import')->debug('TMDB Movie does not exists');
            return;
        }

        $movie['tmdb_id'] = $movie['id'];
        unset($movie['id']);

        $tmdbExists = TMDBMovie::query()->where([
            'tmdb_id' => $movie['tmdb_id']
        ])->exists();

        if ($tmdbExists === true) {
            Log::channel('import')->debug('TMDB Movie exists ', [$movie['title']]);
            return;
        }

        $this->saveMovie($movie);
    }

    public function saveMovie($movie)
    {
        Log::channel('import')->debug('Update movie ', [$movie['title']]);

        if (strlen($movie['release_date']) < 1) {
            $movie['release_date'] = null;
        }

        $createdMovie = TMDBMovie::query()->create($movie);
        unset($createdMovie['id']);

        $createdMovie->data()->create($movie);

        if (isset($movie['imdb_id'])) {
            MDBLCreated::dispatch($movie['imdb_id']);
            Created::dispatch($movie['tmdb_id']);
        }
    }

    public function getMoviesDiscover($page = 0, $year = 2022)
    {
        Log::channel('import')->debug('Get TMDB movies discover page ' . $page);

        $body = ['page' => $page];
        $body['year'] = $year;

        $movies = $this->movieApi->getMoviesDiscover($body);

        if (!empty($movies['results'])) {
            foreach ($movies['results'] as $tmdbMovie) {
                $exists = TMDBMovieDiscover::query()->where(['tmdb_id' => $tmdbMovie['id']])->exists();

                if ($exists === false) {
                    TMDBMovieDiscover::query()->create(['tmdb_id' => $tmdbMovie['id']]);
                    Discovered::dispatch($tmdbMovie['id']);
                }
            }
        }
    }
}
