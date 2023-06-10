<?php

namespace Lariele\MovieApiTMDB\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Lariele\MovieApiTMDB\API\MovieTMDBApi;
use Lariele\MovieApiTMDB\Models\TMDBMovie;
use Symfony\Component\ErrorHandler\Debug;

class GetMovieTranslationsCommand extends Command
{
    protected MovieTMDBApi $movieApi;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'movie-api-tmdb:get-movie-translations {tmdbId}';
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

        $this->getMovieTranslations($tmdbId);
        return Command::SUCCESS;
    }


    private function getMovieTranslations($tmdbId)
    {
        $movie = TMDBMovie::query()->where(['tmdb_id' => $tmdbId])->firstOrFail();

        $this->info('Get TMDB translations ' . $tmdbId);
        Log::channel('import')->debug('Get TMDB translations ' . $tmdbId);

        $movieTranslations = $this->movieApi->getMovieTranslations($tmdbId);

        if (isset($movieTranslations)) {
            $this->info('Update translations ' . $movie['title']);
            Log::channel('import')->debug('Update translations ', [$movie['title']]);

            $movie->translations()->create([
                'tmdb_id' => $tmdbId,
                'results' => $movieTranslations
            ]);
        }
    }
}
