<?php

namespace Lariele\MovieApiTMDB\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class TMDBMovie extends Model
{
    use HasFactory;

    protected $table = 'api_tmdb_movies';

    protected $fillable = [
        'tmdb_id',
        'imdb_id',
        'release_date',
        'status',
        'title',
    ];

    /**
     * Movie Data
     *
     * @return HasOne
     */
    public function data(): HasOne
    {
        return $this->hasOne(TMDBMovieData::class, 'tmdb_id', 'tmdb_id');
    }
}
