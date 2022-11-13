<?php

namespace Lariele\MovieApiTMDB\Components;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Lariele\Movie\Models\Movie;
use Livewire\Component;

class MovieDetail extends Component
{
    public $movie;

    public function mount(Movie $movie)
    {
        $this->movie = $movie;
        #$this->order = OrderModel::query()->where('id', $id)->firstOrFail();
    }

    public function render(): Factory|View|Application
    {
        return view('movie::components.movie-detail');
    }
}
