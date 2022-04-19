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
        
        if (Storage::disk('gcs')->exists($productxx->image)) {
            Storage::disk('gcs')->delete($productxx->image);
        }

        $image_name = $this->image->hashName();
        $product = Product::updateOrCreate(['id' => $this->product_id],
            [
                'image' =>  $this->image->storeAs('images/products', $image_name , 'gcs'),
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
