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

    public function render()
    {
        $products = Product::with('brand', 'category')->where('name', 'like', '%'.$this->search.'%')
        ->orwhere('selling_price', 'like', '%'.$this->search.'%')
        ->orwhere('description', 'like', '%'.$this->search.'%')
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
