<?php

namespace Lariele\MovieApiTMDB;

use Illuminate\Support\ServiceProvider;
use Lariele\MovieApiTMDB\Commands\ConvertMovieCommand;
use Lariele\MovieApiTMDB\Commands\ConvertMoviesCommand;
use Lariele\MovieApiTMDB\Commands\GetMovieCommand;
use Lariele\MovieApiTMDB\Commands\GetMovieCreditsCommand;
use Lariele\MovieApiTMDB\Commands\GetMoviesDiscoverCommand;
use Lariele\MovieApiTMDB\Commands\GetMovieTranslationsCommand;
use Lariele\MovieApiTMDB\Commands\GetMovieWatchProvidersCommand;

class MovieApiTMDBServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(MovieApiTMDBEventServiceProvider::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                GetMoviesDiscoverCommand::class,
                GetMovieCommand::class,
                GetMovieWatchProvidersCommand::class,
                GetMovieCreditsCommand::class,
                GetMovieTranslationsCommand::class,
                ConvertMovieCommand::class,
                ConvertMoviesCommand::class,
            ]);
        }

        $this->loadRoutesFrom(__DIR__ . '/routes.php');

        $this->loadViewsFrom(__DIR__ . '/Resources/views', 'movie-api-tmdb');

        $this->publishes([
            __DIR__ . '/Resources/views' => resource_path('views/vendor/lariele/movie-api-tmdb'),
        ], 'views');

        $this->publishes([
            __DIR__ . '/Database/Factories' => database_path('factories'),
            __DIR__ . '/Database/Migrations' => database_path('migrations'),
            __DIR__ . '/Database/Seeders' => database_path('seeders'),
        ], 'database');

        $this->publishes([
            __DIR__ . '/Config/movieapi.php' => config_path('movieapi.php'),
        ], 'config');

        $this->loadMigrationsFrom(__DIR__ . '/Database/Migrations');
    }
}
