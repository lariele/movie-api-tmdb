<?php

namespace Lariele\MovieApiTMDB\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Lariele\MovieApiMDBL\Events\Created as MDBLCreated;
use Lariele\MovieApiTMDB\API\MovieTMDBApi;
use Lariele\MovieApiTMDB\Events\Created;
use Lariele\MovieApiTMDB\Models\TMDBMovie;

class GetMovieCommand extends Command
{
    protected MovieTMDBApi $movieApi;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'movie-api-tmdb:get-movie';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    public function __construct(MovieTMDBApi $movieApi)
    {
        $this->movieApi = $movieApi;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        for ($i = 0; $i < 3; $i++) {
            $this->getMovie();
            sleep(rand(2, 6));
        }

        return Command::SUCCESS;
    }

    private function getMovie()
    {
        $checkId = rand(1, 6000);

        $movieToCheck = $checkId;

        $this->info('Get TMDB movie ' . $movieToCheck);
        Log::channel('import')->debug('Get TMDB movie ' . $movieToCheck);

        $movie = $this->movieApi->getMovie($movieToCheck);

        Log::channel('import')->debug('Movie data ', [$movie]);

        if (isset($movie['title'])) {
            $this->info('Update movie ' . $movie['title']);
            Log::channel('import')->debug('Update movie ', [$movie['title']]);

            $movie['tmdb_id'] = $movie['id'];
            unset($movie['id']);

            $createdMovie = TMDBMovie::query()->create($movie);
            unset($createdMovie['id']);

            $createdMovie->data()->create($movie);

            MDBLCreated::dispatch($movie['imdb_id']);
            Created::dispatch($movie['imdb_id']);
        }
    }
}
