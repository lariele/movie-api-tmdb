<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Lariele\Movie\Models\TMDBMovie;

class MovieSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        TMDBMovie::factory(1000)->create();
    }
}
