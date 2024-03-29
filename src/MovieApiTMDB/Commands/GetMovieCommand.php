<?php

namespace Lariele\MovieApiTMDB\Commands;

use Illuminate\Console\Command;
use Lariele\MovieApiTMDB\API\MovieTMDBApi;
use Lariele\MovieApiTMDB\Services\MovieApiTMDBImportService;

class GetMovieCommand extends Command
{
    protected MovieTMDBApi $movieTmdbApi;
    protected MovieApiTMDBImportService $movieApiTMDBImportService;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'movie-api-tmdb:get-movie {tmdbId}';
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
        $tmdbId = $this->argument('tmdbId');

        $this->getMovie($tmdbId);

        return Command::SUCCESS;
    }

    private function getMovie($tmdbId)
    {
        $this->movieApiTMDBImportService->getMovie($tmdbId);
    }
}
