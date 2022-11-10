<?php

namespace Lariele\MovieApiTMDB\API;

use Exception;
use Illuminate\Support\Facades\Log;
use Lariele\MovieApiTMDB\API\Config\MovieTMDBApiConfig;

class MovieTMDBRestService
{
    private MovieTMDBApiConfig $config;
    private MovieTMDBApiClient $httpClient;

    private string $method;
    private string $url;

    public function __construct(MovieTMDBApiClient $httpClient, MovieTMDBApiConfig $config)
    {
        $this->config = $config;
        $this->httpClient = $httpClient;
    }

    public function request(string $method, $withUri = null, ?array $body = []): ?array
    {
        $this->method = $method;
        $this->url = $this->config->getRestUrl();
        if ($withUri) {
            $this->url .= $withUri;
        }

        $this->setEndpointParams($body);

        $this->withApiKey($this->config->getApiKey());
        Log::debug('tmdb request', [$this->url]);
        $json = $this->send();

        return $this->prepareResponse($json);
    }

    public function setEndpointParams(?array $params = []): self
    {
        if (!empty($params)) {
            $paramsUrl = http_build_query($params);
            $this->url = implode('?', [$this->url, $paramsUrl]);
        }

        return $this;
    }

    public function withApiKey(?string $apiKey): void
    {
        if (!empty($apiKey)) {
            $this->setEndpointParams([
                'api_key' => $apiKey,
            ]);
        }
    }

    private function send(): ?array
    {
        try {
            $json = $this->httpClient->send($this->method, $this->url);

            if (!empty($json['errors'])) {
                throw new Exception(json_encode($json));
            }

        } catch (Exception $e) {
            return null;
        }

        return $json;
    }

    private function prepareResponse(?array $json): ?array
    {
        $json = $json ?? null;

        if (empty($json)) {
            return null;
        }

        return $json;
    }

    public function withHeaders(array $headers): void
    {
        $this->httpClient->withHeaders($headers);
    }
}
