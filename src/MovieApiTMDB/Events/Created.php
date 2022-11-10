<?php

namespace Lariele\MovieApiTMDB\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class Created
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

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
