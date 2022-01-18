<?php

namespace App\Http\Livewire\Admin;

use App\Models\Product;
use App\Models\Brand;
use App\Models\Category;
use Livewire\WithFileUploads;
use LivewireUI\Modal\ModalComponent;

class ProductModal extends ModalComponent
{
    use WithFileUploads;

    public $product, $name, $category_id, $brand_id, $product_id, $category_idx, $category_namex, $slug, $description, $selling_price, $quantity, $image;

    public function create(){
        $this->validate([
            'name' => 'required|regex:/[a-zA-Z0-9\s]+/|unique:products,name,'.$this->product_id.'',
            'category_id' => 'required',
            'brand_id' => 'required',
            'description' => 'required|regex:/[a-zA-Z0-9\s]+/|max:255',
            'selling_price' => 'required|numeric|min:0|max:1000000.00',
            'quantity' => 'required|integer|min:0|max:999999',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif
            max:2048',
        ]);

        $product = Product::updateOrCreate(['id' => $this->product_id],
            ['name' => $this->name,
            'category_id' => $this->category_id,
            'brand_id' => $this->brand_id,
            'description' => $this->description,
            'selling_price' => $this->selling_price,
            'image' =>  $this->image->store('images/products', 'public'),
            'quantity' => $this->quantity]
        );

        
        $this->emit("openModal", "admin.success-modal", ["message" => $this->product_id ? 'Product Updated Successfully.' : 'Product Added Successfully']);
        $this->resetInputFields();
 
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
