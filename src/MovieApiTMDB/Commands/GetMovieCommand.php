<?php

namespace Lariele\MovieApiTMDB\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Lariele\MovieApiTMDB\API\MovieTMDBApi;
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
            sleep(2);
        }

        return Command::SUCCESS;
    }

    private function getMovie()
    {
        $this->info('Get TMDB movie');


        $checkId = rand(1, 6000);

        $movieToCheck = $checkId;

        Log::channel('import')->debug('movie to check ' . $movieToCheck);

        $movie = $this->movieApi->getMovie($movieToCheck);

        Log::channel('import')->debug('movie ', [$movie]);

        if (isset($movie['title'])) {
            $movie['tmdb_id'] = $movie['id'];
            unset($movie['id']);
            TMDBMovie::query()->create($movie);
        }
    }
}
