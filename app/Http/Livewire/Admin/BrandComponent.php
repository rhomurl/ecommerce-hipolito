<?php

namespace App\Http\Livewire\Admin;

use App\Models\Brand;
use App\Models\Product;
use Livewire\WithPagination;
use DB;
use Livewire\Component;

class BrandComponent extends Component
{
    protected $listeners = ['updateComponent' => 'render'];
    public $search = "";

    use WithPagination;
    
    public function render()
    {
        $brands = Brand::where('name', 'like', '%'.$this->search.'%')->paginate(10);
        return view('livewire.admin.brand-component', compact('brands'))->layout('layouts.admin');
    }

    public function edit($id){
        $this->emit("openModal", "admin.brand-edit", ["id" => $id]);
    }

    public function confirmDelete($id)
    {
        $product_qty = DB::table('products')->where('brand_id', '=', $id)->whereNotNull('quantity')->get();

        if(count($product_qty)){
            $this->emit("openModal", "admin.failed-modal", ["message" => 'This brand cannot be deleted']); 
        }
        else{
            $this->emit("openModal", "admin.success-modal", ["message" => 'Brand Deleted Successfully']); 
            Brand::where('id', $id)->delete();  
        }     
    }
}
