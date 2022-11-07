<?php

namespace Lariele\MovieApiTMDB\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TMDBMovie extends Model
{
    use HasFactory;

    protected $table = 'api_tmdb_movies';

    protected $fillable = [
        'title',

    ];

    protected $casts = [
        'genres' => 'collection',
        'actors' => 'collection',
    ];

}
