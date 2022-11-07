<?php

namespace Lariele\MovieApiTMDB\API;

class MovieTMDBApi
{
    private MovieTMDBRestService $service;

    public function __construct(MovieTMDBRestService $service)
    {
        $this->service = $service;
    }

    public function getMovie(string $id)
    {
        return $this->getTMDBMovie($id);
    }

    public function getTMDBMovie(int $id): ?array
    {
        return $this->service->request('get', 'movie/' . $id);
    }
}
