<?php

namespace App\Http\Livewire\Admin;


use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\Product;

use App\Traits\ModelComponentTrait;


use Livewire\WithPagination;
use Livewire\Component;
use DB;

class CategoryComponent extends Component
{
    use LivewireAlert;
    use ModelComponentTrait;
    use WithPagination;

    protected $listeners = ['updateComponent' => 'render'];
    public $search = "";

    public function render()
    {
        $categories = $this->getData(new Category());
        return view('livewire.admin.category-component', compact('categories'))->layout('layouts.admin');
    }

    public function edit($id){
        $this->emit("openModal", "admin.category-edit", ["id" => $id]);
    }

    public function confirmDelete($id)
    {
        $product_qty = DB::table('products')->where('category_id', '=', $id)->whereNotNull('quantity')->get();
        if(count($product_qty)){
            $this->errorAlert('This Category Cannot Be Deleted!');
        }
        else{
            $category = Category::updateOrCreate(['id' => $id], ['deleted_by' => Auth::user()->id,]);
            //$category = Category::updateOrCreate(['id' => $id], ['deleted_by' => '',]);
            $category->delete();
            $this->successAlert('Category Deleted Successfully!');
        }     
    }
}