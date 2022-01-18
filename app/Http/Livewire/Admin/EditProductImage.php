<?php

namespace App\Http\Livewire\Admin;

use App\Models\Product;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use LivewireUI\Modal\ModalComponent;

class EditProductImage extends ModalComponent
{
    use WithFileUploads;

    public $image;

    public function mount($id){
        $this->product_id = $id;
        $product = Product::findOrFail($this->product_id);
        $this->image = $product->image;
    }

    public function create(){
        $this->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $productxx = Product::findOrFail($this->product_id);
        
        if(Storage::exists('public/' . $productxx->image)){
            Storage::delete('public/' . $productxx->image);
            /*
                Delete Multiple File like this way
                Storage::delete(['upload/test.png', 'upload/test2.png']);
            */
        }else{
            dd('File does not exists.');
        }

        $product = Product::updateOrCreate(['id' => $this->product_id],
            [
                'image' =>  $this->image->store('images/products', 'public'),
            ]
        );
        $this->emit("openModal", "admin.success-modal", ["message" => $this->product_id ? 'Image Updated Successfully.' : 'Image Added Successfully']);
    }


    public function render()
    {
        return view('livewire.admin.edit-product-image');
    }
}
