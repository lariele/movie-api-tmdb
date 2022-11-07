<?php

namespace Lariele\MovieApiTMDB\API\Config;

class MovieTMDBApiConfig
{
    private $url;
    private $apiKey;

    public function __construct()
    {
        #$this->url = config('app.coin_ranking_api_url');
        $this->url = 'https://mdblist.p.rapidapi.com';
        #$this->apiKey = config('app.coin_ranking_api_key');
        $this->apiKey = 'ff9e3c1ea0mshf9363246696e0d8p1069e4jsn5489664f3c01';
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
