<?php

namespace Lariele\MovieApiTMDB\API;

class MovieTMDBApi
{
    private MovieTMDBRestService $service;

    public function __construct(MovieTMDBRestService $service)
    {
        $this->service = $service;
    }

    public function getMovie(string $id): ?array
    {
        return $this->service->request('get', 'movie/' . $id, ['append_to_response' => 'keywords,images,videos,credits,external_ids']);
    }

    public function getMovieCredits(string $id): ?array
    {
        return $this->service->request('get', 'movie/' . $id . '/credits');
    }

    public function getMovieWatchProviders(string $id): ?array
    {
        return $this->service->request('get', 'movie/' . $id . '/watch/providers');
    }

}
