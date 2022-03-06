<?php

namespace App\Http\Livewire\Admin;

use Jantinnerezo\LivewireAlert\LivewireAlert;

use App\Models\Product;
use App\Models\Brand;
use App\Models\Category;
use App\Traits\ModelComponentTrait;

//use Livewire\WithFileUploads;
use LivewireUI\Modal\ModalComponent;

class ProductEdit extends ModalComponent
{
    use LivewireAlert;
    use ModelComponentTrait;
    //use WithFileUploads;

    public $product, $name, $category_id, $brand_id, $product_id, $slug, $description, $selling_price, $quantity, $image;

    public function mount($id)
    {
        $this->product_id = $id;
        $product = Product::findOrFail($this->product_id);
        $this->name = $product->name;
        $this->category_id = $product->category_id;
        $this->brand_id = $product->brand_id;
        $this->slug = $product->slug;
        $this->description = $product->description;
        $this->selling_price = $product->selling_price;
        $this->quantity = $product->quantity;
    }

    public function create(){
        $this->validate([
            'name' => 'required|regex:/[a-zA-Z0-9\s]+/|unique:products,name,'.$this->product_id.'',
            'category_id' => 'required',
            'brand_id' => 'required',
            'description' => 'required|regex:/[a-zA-Z0-9\s]+/|max:255',
            'selling_price' => 'required|numeric|min:0|max:1000000.00',
            'quantity' => 'required|integer|min:0|max:999999',
            //'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        
        $product = Product::updateOrCreate(['id' => $this->product_id],
            ['name' => $this->name,
            'category_id' => $this->category_id,
            'brand_id' => $this->brand_id,
            'description' => $this->description,
            'selling_price' => $this->selling_price,
            // 'image' =>  $this->image->store('images/products', 'public'),
            'quantity' => $this->quantity]
        );
        
        //$this->emit("openModal", "admin.success-modal", ["message" => $this->product_id ? 'Product Updated Successfully.' : 'Product Added Successfully']);
        $this->resetInputFields();
        $this->closeModal();
        $this->successAlert('Product Updated Successfully!');
    }
    
    public function render()
    {
        $categories = Category::orderBy('name', 'ASC')->get();
        $brands = Brand::orderBy('name', 'ASC')->get();
        return view('livewire.admin.product-edit', compact('categories', 'brands'));
    }
}
