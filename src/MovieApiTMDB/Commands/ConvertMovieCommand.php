<?php

namespace Lariele\MovieApiTMDB\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Lariele\MovieApiTMDB\API\MovieTMDBApi;
use Lariele\MovieApiTMDB\Models\TMDBMovie;
use Lariele\MovieApiTMDB\Services\MovieApiTMDBConvertService;

class ConvertMovieCommand extends Command
{
    protected MovieTMDBApi $movieApi;
    protected MovieApiTMDBConvertService $convertService;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'movie-api-tmdb:convert-movie {tmdbId}';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    public function __construct(MovieTMDBApi $movieApi, MovieApiTMDBConvertService $convertService)
    {
        $this->movieApi = $movieApi;
        $this->convertService = $convertService;
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

        $this->convertMovie($tmdbId);

        return Command::SUCCESS;
    }

    private function convertMovie($tmdbId)
    {
        $tmdbMovie = TMDBMovie::query()->where(['tmdb_id' => $tmdbId])->firstOrFail();

        $this->info('Convert TMDB movie ' . $tmdbId);
        Log::channel('convert')->debug('Convert TMDB movie ' . $tmdbId);

        $movie = $this->convertService->convertMovie($tmdbMovie);
    }

}
