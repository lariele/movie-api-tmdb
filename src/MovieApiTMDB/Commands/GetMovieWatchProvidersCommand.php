<?php

namespace Lariele\MovieApiTMDB\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Lariele\MovieApiTMDB\API\MovieTMDBApi;
use Lariele\MovieApiTMDB\Models\TMDBMovie;

class GetMovieWatchProvidersCommand extends Command
{
    protected MovieTMDBApi $movieApi;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'movie-api-tmdb:get-movie-providers {tmdbId}';
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
        $tmdbId = $this->argument('tmdbId');

        $this->getMovieProviders($tmdbId);
        return Command::SUCCESS;
    }

    private function getMovieProviders($tmdbId)
    {
        $movie = TMDBMovie::query()->where(['tmdb_id' => $tmdbId])->firstOrFail();

        $this->info('Get TMDB providers ' . $tmdbId);
        Log::channel('import')->debug('Get TMDB providers ' . $tmdbId);

        $movieProviders = $this->movieApi->getMovieWatchProviders($tmdbId);

        //Log::channel('import')->debug('Movie providers ', [$movieProviders]);

        if (isset($movieProviders['results'])) {
            $this->info('Update providers ' . $movie['title']);
            Log::channel('import')->debug('Update providers ', [$movie['title']]);

            $movie->providers()->create($movieProviders);
        }
    }
}
