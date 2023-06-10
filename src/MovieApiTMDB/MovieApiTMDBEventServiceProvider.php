<?php

namespace Lariele\MovieApiTMDB;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Lariele\MovieApiTMDB\Events\Created;
use Lariele\MovieApiTMDB\Events\Discovered;
use Lariele\MovieApiTMDB\Listeners\CheckMovieProviders;
use Lariele\MovieApiTMDB\Listeners\ConvertMovie;
use Lariele\MovieApiTMDB\Listeners\GetMovie;
use Lariele\MovieApiTMDB\Listeners\GetMovieCredits;
use Lariele\MovieApiTMDB\Listeners\GetMovieProviders;
use Lariele\MovieApiTMDB\Listeners\GetMovieTranslations;

class MovieApiTMDBEventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Created::class => [
            GetMovieProviders::class,
            GetMovieCredits::class,
            GetMovieTranslations::class,
            ConvertMovie::class,
        ],
        Discovered::class => [
            GetMovie::class,
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
