<?php

namespace Lariele\MovieApiTMDB\Commands;

use Illuminate\Console\Command;
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
        $this->getMoviesDiscover();

        return Command::SUCCESS;
    }

    private function getMoviesDiscover()
    {
        $page = rand(1, 300);

        $this->movieApiTMDBImportService->getMoviesDiscover($page);
    }
}
