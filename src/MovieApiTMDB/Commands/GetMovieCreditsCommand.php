<?php

namespace Lariele\MovieApiTMDB\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Lariele\MovieApiTMDB\API\MovieTMDBApi;
use Lariele\MovieApiTMDB\Models\TMDBMovie;

class GetMovieCreditsCommand extends Command
{
    protected MovieTMDBApi $movieApi;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'movie-api-tmdb:get-movie-credits {tmdbId}';
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

        $this->getMovieCredits($tmdbId);
        return Command::SUCCESS;
    }

    private function getMovieCredits($tmdbId)
    {
        $movie = TMDBMovie::query()->where(['tmdb_id' => $tmdbId])->firstOrFail();

        $this->info('Get TMDB credits ' . $tmdbId);
        Log::channel('import')->debug('Get TMDB credits ' . $tmdbId);

        $movieCredits = $this->movieApi->getMovieCredits($tmdbId);

        Log::channel('import')->debug('Movie credits ', [$movieCredits]);

        if (isset($movieCredits['cast']) || isset($movieCredits['crew'])) {
            $this->info('Update credits ' . $movie['title']);
            Log::channel('import')->debug('Update credits ', [$movie['title']]);

            $movie->persons()->create($movieCredits);
        }
    }
}
