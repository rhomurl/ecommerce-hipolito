<?php

namespace App\Http\Livewire\Admin;

//use App\Models\Order;
use App\Models\User;
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
        $this->cancelled = resolve(OrderService::class)->displayOrders('cancelled', 'count');
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

    public function getAdminName($id){
        $usr = User::find($id);
        return $usr->name;
    }

    public function render()
    {   
        $orders = resolve(OrderService::class)->displayOrders2($this->status, 'display', $this->sortDirection, $this->sortColumn)->search($this->search)->paginate(10);

        return view('livewire.admin.order-user-component', compact('orders'))->layout('layouts.admin');
    }
}
