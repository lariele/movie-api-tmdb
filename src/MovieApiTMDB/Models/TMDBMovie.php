<?php

namespace Lariele\MovieApiTMDB\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class TMDBMovie extends Model
{
    use HasFactory;
    
    protected $primaryKey = 'tmdb_id';

    protected $table = 'api_tmdb_movies';

    protected $fillable = [
        'tmdb_id',
        'imdb_id',
        'release_date',
        'status',
        'title',
        'processed_at',
    ];

    protected $dates = [
        'processed_at'
    ];

    protected $casts = [
        'release_date' => 'datetime:Y-m-d',
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

    /**
     * Movie Persons
     *
     * @return HasOne
     */
    public function persons(): HasOne
    {
        return $this->hasOne(TMDBMoviePersons::class, 'tmdb_id', 'tmdb_id');
    }

    /**
     * Movie Providers
     *
     * @return HasOne
     */
    public function providers(): HasOne
    {
        return $this->hasOne(TMDBMovieProviders::class, 'tmdb_id', 'tmdb_id');
    }
}
