<?php

namespace App\Http\Livewire\Admin;

use Jantinnerezo\LivewireAlert\LivewireAlert;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Category;
use Livewire\WithFileUploads;
use LivewireUI\Modal\ModalComponent;

class ProductModal extends ModalComponent
{
    use LivewireAlert;
    use WithFileUploads;

    public $product, $name, $category_id, $brand_id, $product_id, $category_idx, $category_namex, $slug, $description, $selling_price, $quantity, $image;

    public function create(){
            //'image.mimes' => 'Only jpeg, png, jpg is allowed!',


        $this->validate([
            //'name' => 'required|regex:/[a-zA-Z0-9\s]+/|unique:products,name,'.$this->product_id.'',
            'name' => 'required|regex:/[a-zA-Z0-9\s]+/|unique:products',
            'category_id' => 'required',
            'brand_id' => 'required',
            'description' => 'required|regex:/[a-zA-Z0-9\s]+/|max:500',
            'selling_price' => 'required|numeric|min:0|max:1000000.00',
            'quantity' => 'required|integer|min:0|max:999999',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);             

        $image_name = $this->image->hashName();
        //$extension = $this->image->extension();
        //$image_name = $name . '.' . $extension;

        $product = Product::updateOrCreate(['id' => $this->product_id],
            ['name' => $this->name,
            'category_id' => $this->category_id,
            'brand_id' => $this->brand_id,
            'description' => $this->description,
            'selling_price' => $this->selling_price,
            'image' =>  $this->image->storeAs('images/products', $image_name , 'gcs'),
            'quantity' => $this->quantity]
        );

        
        //$this->emit("openModal", "admin.success-modal", ["message" => $this->product_id ? 'Product Updated Successfully.' : 'Product Added Successfully']);
        $this->resetInputFields();
        $this->closeModal();

        $this->alert('success', 'Product Created Successfully!', [
            'position' => 'center',
            'timer' => '1500',
            'toast' => false,
            'timerProgressBar' => true,
            'width' => '600',
           ]);
        $this->emit('updateComponent');
 
    }

    private function resetInputFields(){
        $this->reset();
        $this->resetValidation();
    }

    public function render()
    {
        $categories = Category::all();
        $brands = Brand::all();

        return view('livewire.admin.product-modal', compact('categories', 'brands'));
    }
}
