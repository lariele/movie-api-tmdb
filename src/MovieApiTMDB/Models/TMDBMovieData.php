<?php

namespace Lariele\MovieApiTMDB\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TMDBMovieData extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'api_tmdb_movies_data';
    protected $fillable = [
        'adult',
        'backdrop_path',
        'budget',
        'genres',
        'homepage',
        'tmdb_id',
        'original_language',
        'original_title',
        'overview',
        'popularity',
        'poster_path',
        'production_companies',
        'production_countries',
        'revenue',
        'runtime',
        'spoken_languages',
        'tagline',
        'video',
        'vote_average',
        'vote_count',
        'videos',
        'images',
        'credits',
        'external_ids',
    ];

    protected $casts = [
        'genres' => 'collection',
        'production_companies' => 'collection',
        'production_countries' => 'collection',
        'spoken_languages' => 'collection',
        'videos' => 'collection',
        'images' => 'collection',
        'credits' => 'collection',
        'external_ids' => 'collection',
    ];

}
