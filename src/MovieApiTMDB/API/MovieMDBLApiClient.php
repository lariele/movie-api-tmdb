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

    public function withApiKey(?string $apiKey): void
    {
        if (!empty($apiKey)) {
            $this->withHeaders([
                'X-RapidAPI-Key' => $apiKey,
                'X-RapidAPI-Host' => 'mdblist.p.rapidapi.com'
            ]);
        }
    }

    public function withHeaders(array $headers): void
    {
        $this->httpClient->withHeaders($headers);
    }

    public function send(string $method, string $url)
    {
        return $this->httpClient->send($method, $url)->json();
    }
}
