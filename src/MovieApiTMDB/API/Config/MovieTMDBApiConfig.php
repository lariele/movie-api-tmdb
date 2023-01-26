<?php

namespace Lariele\MovieApiTMDB\API\Config;

class MovieTMDBApiConfig
{
    private $url;
    private $apiKey;

    public function __construct()
    {
        $this->url = 'https://api.themoviedb.org/3/';
        $this->apiKey = config('movieapi.tmdb.key');
    }

    public function getApiKey(): string
    {
        return $this->apiKey;
    }

    public function getRestUrl(): string
    {
        return $this->url;
    }
}
