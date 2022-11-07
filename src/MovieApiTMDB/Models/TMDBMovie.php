<?php

namespace Lariele\MovieApiTMDB\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TMDBMovie extends Model
{
    use HasFactory;

    protected $table = 'api_tmdb_movies';

    protected $fillable = [
        'adult',
        'backdrop_path',
        'genres',
        'tmdb_id',
        'imdb_id',
        'title',
        'processed_at',

    ];

    protected $casts = [
        'genres' => 'collection',
    ];

}
