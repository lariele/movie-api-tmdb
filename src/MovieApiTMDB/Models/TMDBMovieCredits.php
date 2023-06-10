<?php

namespace Lariele\MovieApiTMDB\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TMDBMovieCredits extends Model
{
    protected $table = 'api_tmdb_movies_credits';

    protected $fillable = [
        'results',
        'tmdb_id',
        'processed_at',
    ];

    protected $dates = [
        'processed_at'
    ];

    protected $casts = [
        'results' => 'collection',
    ];
}
