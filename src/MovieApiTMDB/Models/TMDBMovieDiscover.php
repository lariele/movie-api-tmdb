<?php

namespace Lariele\MovieApiTMDB\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TMDBMovieDiscover extends Model
{
    use HasFactory;

    protected $table = 'api_tmdb_movies_discover';

    protected $fillable = [
        'tmdb_id',
        'processed_at',
    ];

    protected $dates = [
        'processed_at'
    ];
}
