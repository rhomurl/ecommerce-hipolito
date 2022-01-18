<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use App\Models\Product;
use Livewire\WithPagination;
use DB;
use Livewire\Component;

class CategoryComponent extends Component
{
    protected $listeners = ['updateComponent' => 'render'];

    use WithPagination;

    public $isOpen = 0;
    public $search = "";

    public function render()
    {
        
        $categories = Category::where('name', 'like', '%'.$this->search.'%')->paginate(10);
        return view('livewire.admin.category-component', compact('categories'))->layout('layouts.admin');
    }

    public function edit($id){
        $this->emit("openModal", "admin.category-edit", ["id" => $id]);
    }

    public function confirmDelete($id)
    {
        $product_qty = DB::table('products')->where('category_id', '=', $id)->whereNotNull('quantity')->get();
        if(count($product_qty)){
            $this->emit("openModal", "admin.failed-modal", ["message" => 'This category cannot be deleted']); 
        }
        else{
            $this->emit("openModal", "admin.success-modal", ["message" => 'Category Deleted Successfully']); 
            Category::where('id', $id)->delete();
        }     
    }
}