<?php

namespace Lariele\MovieApiTMDB\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Lariele\MovieApiTMDB\API\MovieTMDBApi;
use Lariele\MovieApiTMDB\Services\MovieApiTMDBImportService;

class GetMoviesDiscoverCommand extends Command
{
    protected MovieTMDBApi $movieApi;
    protected MovieApiTMDBImportService $movieApiTMDBImportService;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'movie-api-tmdb:get-movies-discover';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    public function __construct(MovieApiTMDBImportService $movieApiTMDBImportService)
    {
        $this->movieApiTMDBImportService = $movieApiTMDBImportService;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        for ($i = 0; $i < 10; $i++) {
            $this->getMoviesDiscover();
            sleep(0.3);
        }

        return Command::SUCCESS;
    }

    private function getMoviesDiscover()
    {
        $pageLast = Cache::get('movie_api_tmdb_lastpage', 0);
        $yearLast = Cache::get('movie_api_tmdb_lastyear', 2022);

        $page = $pageLast + 1;
        $year = $yearLast;

        if ($page > 300) {
            $page = 1;
            $year = $yearLast - 1;
            Cache::put('movie_api_tmdb_lastyear', $year);
        }

        Log::debug('lastpage', [$page]);
        Log::debug('lastyear', [$year]);
        Cache::put('movie_api_tmdb_lastpage', $page);

        $this->movieApiTMDBImportService->getMoviesDiscover($page, $year);
    }
}
