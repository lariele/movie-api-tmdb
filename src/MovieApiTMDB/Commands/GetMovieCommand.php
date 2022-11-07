<?php

namespace Lariele\MovieApiTMDB\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Lariele\MovieApiTMDB\API\MovieTMDBApi;
use Lariele\MovieApiTMDB\Models\TMDBMovie;

class GetMovieCommand extends Command
{
    protected MovieTMDBApi $movieApi;
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
    public function handle()
    {
        $this->info('Get TMDB movie');

        $checkId = '';
        exit();
        $rs = (string)rand(12585152, 12595152);
        #$rs = '7631066';

        $checkId = 'tt' . $rs;
        #$movieToCheck = 'tt5180504';
        $ids = [
            'tt13207736',
            'tt1877830',
            'tt5523010',
            'tt12585152',
        ];

        #$checkId = $ids[rand(0, (count($ids)))];

        $movieToCheck = $checkId;

        Log::debug('movie to check', [$movieToCheck]);
        $movie = $this->movieApi->getMovie($movieToCheck);

        if (isset($movie['title'])) {
            TMDBMovie::query()->create($movie);
        }

        Log::debug('movie', [$movie]);
        return Command::SUCCESS;
    }
}
