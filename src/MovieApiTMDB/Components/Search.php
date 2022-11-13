<?php

namespace Lariele\MovieApiTMDB\Components;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Search extends Component
{
    public $filter;

    public $results;

    public function mount()
    {
        $this->results = collect([]);
    }

    public function updatedFilterSearch($value)
    {
        $this->search($value);
    }

    public function search($value)
    {
        $this->results = !empty($value) ? Order::query()
            ->where('name', 'LIKE', '%' . $value . '%')
            ->limit(10)
            ->get() : collect([]);
    }

    public function render(): Factory|View|Application
    {
        return view('orders.components.search');
    }
}
