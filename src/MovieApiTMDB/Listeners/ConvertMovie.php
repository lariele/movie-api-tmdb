<?php

namespace Lariele\MovieApiTMDB\Listeners;

use Illuminate\Support\Facades\Artisan;
use Lariele\MovieApiTMDB\Events\Created;

class ConvertMovie
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
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
        Artisan::call('movie-api-tmdb:convert-movie', ['tmdbId' => $event->tmdbId]);
    }
}
