<?php

namespace App\Http\Livewire\Admin;

use App\Models\{Product, Brand, Category};
use App\Services\ActivityLogService;
use App\Traits\ModelComponentTrait;
use Jantinnerezo\LivewireAlert\LivewireAlert;

use LivewireUI\Modal\ModalComponent;

class ProductEdit extends ModalComponent
{
    use LivewireAlert;
    use ModelComponentTrait;

    public $product, $name, $category_id, $brand_id, $product_id, $slug, $description, $selling_price, $quantity, $image, $old;

    protected $messages = [
        'selling_price.max' => 'Price cannot be exceeded by 1000000.00', 
        'quantity.max' => 'Quantity cannot exceed by 999999.',
        'image.max' => 'Image cannot exceed 2MB.',
        'image.image' => 'JPEG, PNG, and JPG are the allowed file types.',
    ];

    public function mount(Product $product)
    {
        $this->old = [
            [
            'name' => $product->name, 
            'slug' => $product->slug,
            'category_id' => $product->category_id, 
            'brand_id' => $product->brand_id,
            'description' => $product->description,
            'selling_price' => $product->selling_price,
            'quantity' => $product->quantity,
            ]
        ];
        $this->product_id = $product->id;
        $this->name = $product->name;
        $this->category_id = $product->category_id;
        $this->brand_id = $product->brand_id;
        $this->slug = $product->slug;
        $this->description = $product->description;
        $this->selling_price = $product->selling_price;
        $this->quantity = $product->quantity;
    }

    public function edit(ActivityLogService $activity){
        $this->validate([
            'name' => 'required|max:60|regex:/[a-zA-Z0-9\s]+/|unique:products,name,'.$this->product_id.'',
            'category_id' => 'required',
            'brand_id' => 'required',
            'description' => 'required|regex:/[a-zA-Z0-9\s]+/|max:500',
            'selling_price' => 'required|numeric|min:0|max:1000000.00',
            'quantity' => 'required|integer|min:0|max:999999',
        ]);

        
        $product = Product::updateOrCreate(['id' => $this->product_id],
            ['name' => $this->name,
            'category_id' => $this->category_id,
            'brand_id' => $this->brand_id,
            'description' => $this->description,
            'selling_price' => $this->selling_price,
            'quantity' => $this->quantity]
        );

        $old = $this->old;
        $attributes = [
            [
            'name' => $product->name, 
            'slug' => $product->slug,
            'category_id' => $product->category_id, 
            'brand_id' => $product->brand_id,
            'description' => $product->description,
            'selling_price' => $product->selling_price,
            'quantity' => $product->quantity,
            ]
        ];
        $activity->createLog($product, $old, $attributes, 'Updated product');
        
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
