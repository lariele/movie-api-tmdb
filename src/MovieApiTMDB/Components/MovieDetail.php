<?php

namespace Lariele\Movie\Components;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Lapierre\Order\Models\Order;

class MovieDetail extends Component
{
    public $order;

    public function mount(Order $order)
    {
        $this->order = $order;
        #$this->order = OrderModel::query()->where('id', $id)->firstOrFail();
    }

    public function render(): Factory|View|Application
    {
        return view('order::components.order-detail');
    }
}
