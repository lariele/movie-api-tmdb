<?php

namespace Lariele\MovieApiTMDB;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Lariele\MovieApiTMDB\Events\Created;
use Lariele\MovieApiTMDB\Listeners\CheckMoviePerson;

class MovieApiTMDBEventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Created::class => [
            CheckMoviePerson::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}
