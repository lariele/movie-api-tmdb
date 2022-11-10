<?php

namespace Lariele\MovieApiTMDB\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TMDBMoviePersons extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'api_tmdb_movies_persons';
    protected $fillable = [
        'cast',
        'crew',
    ];

    protected $casts = [
        'cast' => 'collection',
        'crew' => 'collection',
    ];

}
