<?php

namespace Lariele\MovieApiTMDB\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Lariele\MovieApiTMDB\API\MovieTMDBApi;
use Lariele\MovieApiTMDB\Models\TMDBMovie;
use Lariele\MovieApiTMDB\Services\MovieApiTMDBImportService;

class ConvertMoviesCommand extends Command
{
    protected MovieTMDBApi $movieApi;
    protected MovieApiTMDBImportService $movieApiTMDBImportService;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'movie-api-tmdb:convert-movies';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        $this->convertMovies();

        return Command::SUCCESS;
    }

    private function convertMovies()
    {
        $movies = TMDBMovie::query()->whereNull('processed_at')->limit(1)->get();

        foreach ($movies as $movie) {
            Artisan::call('movie-api-tmdb:convert-movie', ['tmdbId' => $movie->tmdb_id]);
        }
    }
}
