<?php

namespace App\Http\Livewire\Admin;

use App\Traits\ModelComponentTrait;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use App\Models\Brand;
use App\Models\Product;
use Livewire\WithPagination;
use Livewire\Component;
use DB;

class BrandComponent extends Component
{
    use LivewireAlert;
    use ModelComponentTrait;
    use WithPagination;

    protected $listeners = ['updateComponent' => 'render'];
    public $search = "";

    public function render()
    {
        $brands = $this->getData(new Brand());
        return view('livewire.admin.brand-component', compact('brands'))->layout('layouts.admin');
    }

    public function edit($id){
        $this->emit("openModal", "admin.brand-edit", ["id" => $id]);
    }

    public function confirmDelete($id)
    {
        $product_qty = DB::table('products')->where('brand_id', '=', $id)->whereNotNull('quantity')->get();

        if(count($product_qty)){
            //$this->emit("openModal", "admin.failed-modal", ["message" => 'This brand cannot be deleted']); 
            $this->errorAlert('This Brand Cannot Be Deleted!');
        
        }
        else{
            //$this->emit("openModal", "admin.success-modal", ["message" => 'Brand Deleted Successfully']); 
            Brand::where('id', $id)->delete();  
            $this->successAlert('Brand Deleted Successfully!');
        }     
    }
}
