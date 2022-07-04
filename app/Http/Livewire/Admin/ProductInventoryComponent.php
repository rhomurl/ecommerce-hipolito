<?php

namespace App\Http\Livewire\Admin;

use App\Models\ProductInventory;
use App\Traits\ModelComponentTrait;
use Jantinnerezo\LivewireAlert\LivewireAlert;

use Livewire\{Component, WithPagination};

class ProductInventoryComponent extends Component
{
    use ModelComponentTrait;
    use LivewireAlert;

    public $paginate = 10;
    public $sortColumn = 'id';
    public $sortDirection = 'asc';

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
        $inventories = ProductInventory::with('product')
            ->orderBy($this->sortColumn, $this->sortDirection)->paginate($this->paginate);
    

        return view('livewire.admin.product-inventory-component', compact('inventories'))->layout('layouts.admin');
    }



}
