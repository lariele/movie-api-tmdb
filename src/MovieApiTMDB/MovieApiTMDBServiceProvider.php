<?php

namespace Lariele\MovieApiTMDB;

use Illuminate\Support\ServiceProvider;
use Lariele\MovieApiTMDB\Commands\GetMovieCommand;
use Lariele\MovieApiTMDB\Commands\GetMovieCreditsCommand;

#use Lariele\MovieApiTMDB\Components\List\MovieList;
#use Lariele\MovieApiTMDB\Components\List\MovieListRow;

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
                GetMovieCommand::class,
                GetMovieCreditsCommand::class,
            ]);
        }

        $this->loadRoutesFrom(__DIR__ . '/routes.php');

        $this->loadViewsFrom(__DIR__ . '/Resources/views', 'movie-api-tmdbist');
        $this->publishes([
            __DIR__ . '/Resources/views' => resource_path('views/vendor/lariele/movie-api-tmdbist'),
            __DIR__ . '/Database/Factories' => database_path('factories'),
            __DIR__ . '/Database/Migrations' => database_path('migrations'),
            __DIR__ . '/Database/Seeders' => database_path('seeders'),
        ]);

        $this->loadMigrationsFrom(__DIR__ . '/Database/Migrations');

        #Livewire::component('order-list-filter', OrderListFilter::class);
//        Livewire::component('movie-list',MovieList::class);
//        Livewire::component('movie-list-row',MovieListRow::class);
//        Livewire::component('order-search', Search::class);
        //
    }
}
