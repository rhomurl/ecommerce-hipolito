<?php

namespace App\Http\Livewire\Admin;

use App\Models\Product;
use App\Models\ProductInventory;
use App\Traits\ModelComponentTrait;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithFileUploads;
use LivewireUI\Modal\ModalComponent;

class ProductInvModal2 extends ModalComponent
{
    use WithFileUploads;
    use LivewireAlert;
    use ModelComponentTrait;

    public 
    $name, $supplier, $category_id, $brand_id, $received_date, $description, 
    $product_cost, $selling_price, $starting_stock, $image, $reorder_level, $product_id;

    /*
        **DONE : Quantity will be same value as Starting stock
        **DONE : Product id will be inserted once Product has been created
        
            !: To do !
        **DONE : Transfer selling_price to this modal
        **DONE : insert supplier to this modal2
    */
    protected $rules = [
        'product_cost' => 'required|numeric|min:0|max:1000000.00|gt:1.00',
        'selling_price' => 'required|numeric|min:0|max:1000000.00|gt:product_cost',
        'starting_stock' => 'required|integer|min:0|max:999999',
        'reorder_level' => 'required|integer|min:0|max:999999|lt:starting_stock',
        'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
    ];

    protected $messages = [
        'product_cost.max' => 'Price cannot be exceeded by 1000000.00', 
        'starting_stock.max' => 'Starting stock cannot exceed by 999999.',
        'reorder_level.max' => 'Reorder level cannot exceed by 999999.',
        'image.max' => 'Image cannot exceed 2MB.',
        'image.image' => 'JPEG, PNG, and JPG are the allowed file types.',
    ];

    public function mount($input, $name){
        $this->name = $name;
        $this->supplier = $input['supplier'];
        $this->category_id = $input['category_id'];
        $this->brand_id = $input['brand_id'];
        $this->received_date = $input['received_date'];
        $this->description = $input['description'];
    }

    public function create(){
        $this->validate(); 
        $image_name = $this->image->hashName();

        $product = Product::updateOrCreate(['id' => $this->product_id],
        ['name' => $this->name,
        'category_id' => $this->category_id,
        'brand_id' => $this->brand_id,
        'description' => $this->description,
        'selling_price' => $this->selling_price,
        'image' =>  $this->image->storeAs('images/products', $image_name , 'gcs'),
        'quantity' => $this->starting_stock]
        );

        $inventory = ProductInventory::create([
            'status' => '',
            'product_id' => $product->id,
            'supplier' => $this->supplier,
            'product_cost' => $this->product_cost,
            'starting_stock' => $this->starting_stock,
            'reorder_level' => $this->reorder_level
        ]);

        $this->resetInputFields();
        $this->forceClose()->closeModal();
        $this->successAlert('Product Created Successfully!');
    }

    public function render()
    {

        return view('livewire.admin.product-inv-modal2');
    }
}
