<?php

namespace Lariele\MovieApiTMDB\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TMDBMovieProviders extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'api_tmdb_movies_providers';

    protected $primaryKey = 'tmdb_id';

    public $incrementing = false;

    protected $fillable = [
        'results',
        'tmdb_id'
    ];

    protected $casts = [
        'results' => 'collection',
    ];
}
