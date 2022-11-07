<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Lariele\MovieApiTMDB\Models\TMDBMovie;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class MovieFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TMDBMovie::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $this->faker->addProvider(new \Xylis\FakerCinema\Provider\Movie($this->faker));
        $this->faker->addProvider(new \Xylis\FakerCinema\Provider\Person($this->faker));

        return [
            'name' => $this->faker->movie,
            'year' => $this->faker->year(),
            'description' => $this->faker->text(300),
            'rating' => rand(45, 100),
            'rating_imdb' => round(rand(45, 100) / 10, 1),
            'rating_csfd' => rand(45, 100),
            'genres' => $this->faker->movieGenres(3),
            'actors' => $this->faker->actors($gender = null, $count = 2, $duplicates = false),
            'on_netflix' => (rand(1, 3) == 1),
            'on_hbo' => (rand(1, 3) == 1),
            'on_disney' => (rand(1, 3) == 1),
        ];
    }
}
