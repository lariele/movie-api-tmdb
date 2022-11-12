<?php

namespace Lariele\MovieApiTMDB\Listeners;

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
        Artisan::call('movie-api-mdbl:get-movie');
    }
}
