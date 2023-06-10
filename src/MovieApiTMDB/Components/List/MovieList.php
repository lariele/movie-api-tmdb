<?php

namespace Lariele\MovieApiTMDB\Components\List;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Log;
use App\SFD\Movie\Services\MovieListService;
use Livewire\Component;

class MovieList extends Component
{
    public Collection $movies;
    public array $filter = [];
    public int $perPage = 15;
    public int $limit = 15;
    public string $rowView = 'list';
    public bool $showTitle = true;
    public bool $showFilter = true;
    public bool $showMore = true;
    protected $listeners = ['refreshList' => '$refresh'];
    protected MovieListService $service;

    public function boot(MovieListService $service)
    {
        $this->service = $service;
    }

    public function mount()
    {
        $this->getMovies();
    }

    public function getMovies()
    {
        $this->movies = $this->service
            ->getOrderListQuery($this->filter)
            ->limit($this->limit)
            ->get();
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

    public function render(): Factory|View|Application
    {
        return view('movie::components.list.movie-list');
    }
}
