<?php

namespace Lariele\MovieApiTMDB\Listeners;

use Illuminate\Support\Facades\Artisan;
use Lariele\MovieApiTMDB\Events\Discovered;

class GetMovie
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
     * @param Discovered $event
     * @return void
     */
    public function handle(Discovered $event)
    {
        Artisan::call('movie-api-tmdb:get-movie', ['tmdbId' => $event->tmdbId]);
    }
}
