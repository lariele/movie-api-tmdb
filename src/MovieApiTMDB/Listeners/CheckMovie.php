<?php

namespace Lariele\MovieApiTMDB\Listeners;

use Illuminate\Support\Facades\Log;
use Lariele\MovieApiTMDB\Events\Created;

class CheckMovie
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        #Log::debug('check movie constr');
        //
    }

    /**
     * Handle the event.
     *
     * @param Created $event
     * @return void
     */
    public function handle(Created $event)
    {
        #Artisan::call('movie-api-mdbl:get-movie', ['imdbId' => $event->imdbId]);
        Log::debug('TMDB check moviee ' . $event->imdbId);
    }
}
