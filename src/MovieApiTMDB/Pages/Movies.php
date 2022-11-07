<?php

namespace Lariele\Movie\Pages;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Movies extends Component
{
    public function render(): Factory|View|Application
    {
        return view('movie::pages.movies');
    }
}
