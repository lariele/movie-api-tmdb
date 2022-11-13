<?php

namespace Lariele\MovieApiTMDB\Commands;

use Illuminate\Console\Command;
use Lariele\MovieApiTMDB\API\MovieTMDBApi;
use Lariele\MovieApiTMDB\Services\MovieApiTMDBImportService;

class GetMovieCommand extends Command
{
    protected MovieTMDBApi $movieApi;
    protected MovieApiTMDBImportService $movieApiTMDBImportService;

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
            $this->getMovie();
            sleep(1);
        }

        return Command::SUCCESS;
    }

    private function getMovie()
    {
        $checkId = rand(1, 600000);
        //$checkId = 603;
        $movieToCheck = $checkId;

        $this->movieApiTMDBImportService->getMovie($movieToCheck);
    }
}
