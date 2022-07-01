<?php

namespace App\Http\Livewire\Admin;

use App\Models\Order;
//use App\Models\User;
use App\Services\OrderService;
use Livewire\WithPagination;
use Livewire\Component;

class OrderUserComponent extends Component
{
    use WithPagination;
    public $search;
    public $status;
    public $count;
    public $sortColumn = 'id';
    public $sortDirection = 'asc';

    public function mount($status){
        $this->status = $status;
        $this->otw = resolve(OrderService::class)->displayOrders('otw', 'count');
        $this->all = resolve(OrderService::class)->displayOrders('all', 'count');
        $this->ordered = resolve(OrderService::class)->displayOrders('ordered', 'count');
        $this->process = resolve(OrderService::class)->displayOrders('processing', 'count');
        $this->completed = resolve(OrderService::class)->displayOrders('delivered', 'count');
    }

    public function sortByColumn($column)
    {
        if ($this->sortColumn == $column) {
            $this->sortDirection = $this->sortDirection == 'asc' ? 'desc' : 'asc';
        } else {
            $this->reset('sortDirection');
            $this->sortColumn = $column;
        }
    }

    public function render()
    {   
        $orders = resolve(OrderService::class)->displayOrders2($this->status, 'display', $this->sortDirection, $this->sortColumn)->paginate(10);
        /*$orderq = Order::query()->with('user');
        if($this->status == 'all'){
            $orders = $orderq->paginate(5);
        }
        else {
            $orders = $orderq->where('status',  $this->status)
        ->paginate(5);
        }*/

                //$orders = Order::where('status', 'like', '%'.$this->status.'%')
           // ->orWhere('id', 'like', '%'.$this->search.'%')
          //  ->orderby('id', 'DESC')
            //

        return view('livewire.admin.order-user-component', compact('orders'))->layout('layouts.admin');
    }
}
