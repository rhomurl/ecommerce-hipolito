<?php

namespace App\Http\Livewire\Admin;

use App\Models\{Product, Brand, Category};
use App\Traits\ModelComponentTrait;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithFileUploads;
use LivewireUI\Modal\ModalComponent;

class ProductModal extends ModalComponent
{
    use LivewireAlert;
    use WithFileUploads;
    use ModelComponentTrait;

    public $product, $name, $category_id, $brand_id, $product_id, $category_idx, $category_namex, $slug, $description, $selling_price, $quantity, $image;

    protected $rules = [
        'name' => 'required|max:60|regex:/[a-zA-Z0-9\s]+/|unique:products',
        'category_id' => 'required',
        'brand_id' => 'required',
        'description' => 'required|regex:/[a-zA-Z0-9\s]+/|max:500',
        'selling_price' => 'required|numeric|min:0|max:1000000.00',
        'quantity' => 'required|integer|min:0|max:999999',
        'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
    ];

    protected $messages = [
        'selling_price.max' => 'Price cannot be exceeded by 1000000.00', 
        'quantity.max' => 'Quantity cannot exceed by 999999.',
        'image.max' => 'Image cannot exceed 2MB.',
        'image.image' => 'JPEG, PNG, and JPG are the allowed file types.',
    ];

    public function create(){
        $this->validate();             
        //'image.mimes' => 'Only jpeg, png, jpg is allowed!',
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

        $this->resetInputFields();
        $this->closeModal();
        $this->successAlert('Product Created Successfully!');
 
    }

    private function resetInputFields(){
        $this->reset();
        $this->resetValidation();
    }

    public function render()
    {
        $categories = Category::orderBy('name', 'ASC')->get();
        $brands = Brand::orderBy('name', 'ASC')->get();

        return view('livewire.admin.product-modal', compact('categories', 'brands'));
    }
}
