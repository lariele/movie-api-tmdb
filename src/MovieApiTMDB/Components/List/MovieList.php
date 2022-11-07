<?php

namespace Lariele\Movie\Components\List;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Lariele\Movie\Services\MovieListService;

class MovieList extends Component
{
    protected $listeners = ['refreshList' => '$refresh'];

    protected MovieListService $service;

    public Collection $movies;

    public array $filter = [];

    public int $perPage = 15;
    public int $limit = 15;

    public string $rowView = 'list';

    public bool $showTitle = true;
    public bool $showFilter = true;
    public bool $showMore = true;

    public function boot(MovieListService $service)
    {
        $this->service = $service;
    }

    public function mount()
    {
        $this->getMovies();
    }

    public function updatedFilter($value)
    {
        $this->limit = $this->perPage;
        $this->getMovies();
    }

    public function loadMore()
    {
        Log::debug('load more');
        $this->limit += $this->perPage;
        $this->getMovies();
    }

    public function filterViewList()
    {
        $this->rowView = 'list';
        Log::debug('list');
    }

    public function filterViewBoxed()
    {
        $this->rowView = 'grid';
        Log::debug('grid');
    }

    public function getMovies()
    {
        $this->movies = $this->service
            ->getOrderListQuery($this->filter)
            ->limit($this->limit)
            ->get();
    }

    public function render(): Factory|View|Application
    {
        return view('movie::components.list.movie-list');
    }
}
