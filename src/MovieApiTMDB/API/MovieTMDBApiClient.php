<?php

namespace Lariele\MovieApiTMDB\API;

use Illuminate\Http\Client\PendingRequest;

class MovieTMDBApiClient
{
    private PendingRequest $httpClient;

    public function __construct(PendingRequest $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    public function send(string $method, string $url)
    {
        return $this->httpClient->send($method, $url)->json();
    }
}
