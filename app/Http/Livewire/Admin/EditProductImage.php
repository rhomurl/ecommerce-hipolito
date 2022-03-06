<?php

namespace App\Http\Livewire\Admin;

use Jantinnerezo\LivewireAlert\LivewireAlert;

use App\Models\Product;
use App\Traits\ModelComponentTrait;

use Illuminate\Support\Facades\Storage;

use Livewire\WithFileUploads;
use LivewireUI\Modal\ModalComponent;

class EditProductImage extends ModalComponent
{
    use LivewireAlert;
    use ModelComponentTrait;
    use WithFileUploads;

    public $image, $product_id;

    public function mount($id){
        $this->product_id = $id;
        $product = Product::findOrFail($this->product_id);
        $this->image = $product->image;
    }

    public function create(){
        $this->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $productxx = Product::findOrFail($this->product_id);
        
        if(Storage::exists('public/' . $productxx->image)){
            Storage::delete('public/' . $productxx->image);
            /*
                Delete Multiple File like this way
                Storage::delete(['upload/test.png', 'upload/test2.png']);
            */
        }else{
            //dd('File does not exists.');
        }

        $product = Product::updateOrCreate(['id' => $this->product_id],
            [
                'image' =>  $this->image->store('images/products', 'public'),
            ]
        );
        $this->resetInputFields();
        $this->forceClose()->closeModal();
        $this->successAlert('Product Image Updated Successfully!');
        //$this->emit("openModal", "admin.success-modal", ["message" => $this->product_id ? 'Image Updated Successfully.' : 'Image Added Successfully']);
    }


    public function render()
    {
        return view('livewire.admin.edit-product-image');
    }
}
