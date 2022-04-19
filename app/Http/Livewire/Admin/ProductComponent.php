<?php

namespace App\Http\Livewire\Admin;

use Jantinnerezo\LivewireAlert\LivewireAlert;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Traits\ModelComponentTrait;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

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
        $products = Product::where('name', 'like', '%'.$this->search.'%')
        ->orwhere('selling_price', 'like', '%'.$this->search.'%')
        ->orwhere('description', 'like', '%'.$this->search.'%')->paginate($this->pagenum);

        return view('livewire.admin.product-component', compact('products'))->layout('layouts.admin');
    }

    public function edit($id){
        $this->emit("openModal", "admin.product-edit", ["id" => $id]);
    }
    public function confirmDelete($id)
    {
        $prod = Product::where('id', $id)->first();
        $image = $prod->image;
       
        if($prod->quantity > 0){
            //$this->emit("openModal", "admin.failed-modal", ["message" => 'This product cannot be deleted']); 
            $this->errorAlert('This Product Cannot Be Deleted!');
        }
        else{
            if (Storage::disk('gcs')->exists($image)) {
                Storage::disk('gcs')->delete($image);
                /*
                    Delete Multiple File like this way
                    Storage::delete(['upload/test.png', 'upload/test2.png']);
                */
            }
            //$this->emit("openModal", "admin.success-modal", ["message" => 'Product Deleted Successfully']); 
            Product::where('id', $id)->delete();
            $this->successAlert('Product Deleted Successfully!');
        }     
    }
}
