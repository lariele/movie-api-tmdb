<?php

namespace Lariele\MovieApiTMDB\API;

class MovieTMDBApi
{
    public const LIST_PATTERN = '';
    private MovieTMDBRestService $service;

    public function __construct(MovieTMDBRestService $service)
    {
        $this->service = $service;
    }

    public function getMovie(string $id)
    {
        $movie = $this->getTMDBMovie(['i' => $id]);


        return $movie;
    }

    public function getTMDBMovie(array $filterParams): ?array
    {
        return $this->service->request('get', $filterParams);
    }
}
