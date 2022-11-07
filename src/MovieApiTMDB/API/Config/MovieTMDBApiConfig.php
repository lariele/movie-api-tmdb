<?php

namespace Lariele\MovieApiTMDB\API\Config;

class MovieTMDBApiConfig
{
    private $url;
    private $apiKey;

    public function __construct()
    {
        #$this->url = config('app.coin_ranking_api_url');
        $this->url = 'https://api.themoviedb.org/3/';
        #$this->apiKey = config('app.coin_ranking_api_key');
        $this->apiKey = '24b4b3e2b052efb2f28b3c9315d98232';
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
