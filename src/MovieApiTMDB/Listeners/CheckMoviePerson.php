<?php

namespace Lariele\MovieApiTMDB\Listeners;

use Illuminate\Support\Facades\Artisan;
use Lariele\MovieApiTMDB\Events\Created;

class CheckMoviePerson
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
        Artisan::call('movie-api-tmdb:get-movie-credits', ['tmdbId' => $event->tmdbId]);
    }
}
