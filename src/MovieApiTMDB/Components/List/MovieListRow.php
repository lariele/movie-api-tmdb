<?php

namespace Lariele\Movie\Components\List;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Lariele\Movie\Models\TMDBMovie;
use Livewire\Component;

class MovieListRow extends Component
{
    public TMDBMovie $movie;

    public bool $favourite = false;

    public string $rowView = 'list';

    public function mount(TMDBMovie $movie)
    {
        $this->movie = $movie;
    }

    // TODO Trait Favoritable
    public function toggleFavourite()
    {
        $this->favourite = !$this->favourite;
    }

    public function render(): Factory|View|Application
    {
        return view('movie::components.list.row.row-' . $this->rowView);
    }
}
