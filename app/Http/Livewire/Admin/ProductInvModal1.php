<?php

namespace App\Http\Livewire\Admin;

use App\Models\{Product, Brand, Category};

use LivewireUI\Modal\ModalComponent;

class ProductInvModal1 extends ModalComponent
{
    public $name;
    public $input;

    /*
     !: To do
     **DONE : Transfer selling_price to modal2
     **DONE : insert supplier to this modal

    */

    protected $rules = [
        'name' => 'required|max:60|regex:/[a-zA-Z0-9\s]+/|unique:products',
        'input.supplier' => 'required:regex:/^[a-zA-ZÑñ.\s]+$/',
        'input.category_id' => 'required',
        'input.brand_id' => 'required',
        'input.received_date' => 'required|date|before:tomorrow|after:2000-01-01',
        'input.description' => 'required|regex:/[a-zA-Z0-9\s]+/|max:500',
        //'input.quantity' => 'required|integer|min:0|max:999999',
        //'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
    ];

    protected $messages = [
        'input.selling_price.max' => 'Price cannot be exceeded by 1000000.00', 
        'input.quantity.max' => 'Quantity cannot exceed by 999999.',
        'input.received_date.after' => 'Date received must be a date after 1998-01-01',       
        'input.received_date.before' => 'Date received must be a date before tomorrow'
        //'input.image.max' => 'Image cannot exceed 2MB.',
       // 'input.image.image' => 'JPEG, PNG, and JPG are the allowed file types.',
    ];

    

    public function create(){
        
        //$image_name = $this->input->name;
        
       // dd($image_name);

        //$this->input->image->storeAs('images/products', $image_name , 'gcs')
        $this->validate();   
        if($this->input){
            $this->emit("openModal", "admin.product-inv-modal2", 
            [
                'name' => $this->name,
                'input' => $this->input
            ]);
        }
        
    }

    public function closeM(){
        $this->reset();
        $this->forceClose()->closeModal();
    }

    public function render()
    {
        $categories = Category::orderBy('name', 'ASC')->get();
        $brands = Brand::orderBy('name', 'ASC')->get();
        
        return view('livewire.admin.product-inv-modal1', compact('categories', 'brands'));
    }


}
