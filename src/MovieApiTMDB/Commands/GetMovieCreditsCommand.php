<?php

namespace Lariele\MovieApiTMDB\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Lariele\MovieApiMDBL\Events\Created;
use Lariele\MovieApiTMDB\API\MovieTMDBApi;

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
        $this->info('Get TMDB credits ' . $tmdbId);
        Log::channel('import')->debug('Get TMDB credits ' . $tmdbId);

        $movieCredits = $this->movieApi->getMovieCredits($tmdbId);

        Log::channel('import')->debug('Movie credits data ', [$movieCredits]);
        exit();
        if (isset($movie['title'])) {
            $this->info('Update credits ' . $movie['title']);
            Log::channel('import')->debug('Update credits ', [$movie['title']]);

            $movie['tmdb_id'] = $movie['id'];
            unset($movie['id']);

            #TMDBMovie::query()->create($movie);
            Created::dispatch($movie['imdb_id']);
        }
    }
}
