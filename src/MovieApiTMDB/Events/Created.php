<?php

namespace Lariele\MovieApiTMDB\Events;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;

class Created implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable;

    public string $tmdbId;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($tmdbId)
    {
        $this->tmdbId = $tmdbId;
    }
}
