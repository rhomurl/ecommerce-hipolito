<?php

namespace App\Http\Livewire\Admin;

use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Support\{Str,Facades\Storage};
use App\Models\{Product,Category,Brand};
use App\Traits\ModelComponentTrait;
use Livewire\{Component, WithPagination, WithFileUploads};
use App\Services\ProductService;

class ProductComponent extends Component
{
    use LivewireAlert;
    use ModelComponentTrait;
    use WithFileUploads;
    use WithPagination;

    //https://laravel-livewire.com/docs/2.x/query-string
    protected $listeners = ['updateComponent' => 'render'];
    
    public $isOpen = 0;
    public $search = "";
    public $pagenum = 10;
    public $sortColumn = 'name';
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
        $products = Product::with('brand', 'category');
        $products = $products->search($this->search)
            ->orderBy($this->sortColumn, $this->sortDirection)
            ->paginate($this->pagenum);

        return view('livewire.admin.product-component', compact('products'))->layout('layouts.admin');
    }

    public function edit($id){
        $this->emit("openModal", "admin.product-edit", ["id" => $id]);
    }

    public function confirmDelete($id)
    {
        resolve(ProductService::class)->deleteProduct($id);
    }
}
