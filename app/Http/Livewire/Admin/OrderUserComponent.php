<?php

namespace App\Http\Livewire\Admin;

use App\Models\Order;
//use App\Models\User;
use Livewire\WithPagination;
use Livewire\Component;

class OrderUserComponent extends Component
{
    use WithPagination;
    public $search;

    public function render()
    {
        $orders = Order::where('status', 'like', '%'.$this->search.'%')
            ->orWhere('id', 'like', '%'.$this->search.'%')
            ->orderby('id', 'DESC')
            ->paginate(10);

        return view('livewire.admin.order-user-component', compact('orders'))->layout('layouts.admin');
    }
}
