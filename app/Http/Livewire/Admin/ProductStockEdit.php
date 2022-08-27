<?php

namespace App\Http\Livewire\Admin;

use App\Models\{Product, ProductStock};
use App\Traits\ModelComponentTrait;
use Jantinnerezo\LivewireAlert\LivewireAlert;

use LivewireUI\Modal\ModalComponent;

class ProductStockEdit extends ModalComponent
{
    use LivewireAlert, ModelComponentTrait;

    public $quantity = 0, $updated_quantity, $action, $err_message, $remark, $product_id, $name, $myquantity; 

    protected $rules = [
        'action' => 'required',
        'quantity' => 'required|integer',
        'updated_quantity' => 'gt:0',
        'remark' => 'required_if:action,remove'
    ];

    public function mount(Product $product){
        $this->product_id = $product->id;
        $this->name = $product->name;
        $this->myquantity = $product->quantity;
    }

    public function updatedQuantity($value){
        if($value){
            if($this->action == 'add'){
                $this->updated_quantity = $this->myquantity + $value;
            }  else if($this->action == 'remove'){
                $this->updated_quantity = $this->myquantity - $value;
            }
            else{
                $this->err_message = 'Select an action first!';
            }
        }
    }

    public function updatedAction(){
        $this->err_message = '';
        if($this->quantity){
            if($this->action == 'add'){
                $this->updated_quantity = $this->myquantity + $this->quantity;
            }  else if($this->action == 'remove'){
                $this->updated_quantity = $this->myquantity - $this->quantity;
            }
        }
    }

    public function render()
    {
        return view('livewire.admin.product-stock-edit');
    }

    public function edit(){
        $this->validate();

        ProductStock::create([
            'product_id' => $this->product_id,
            'quantity' => $this->action == 'add' ? $this->quantity : -$this->quantity,
            'remarks' => $this->action == 'add' ? 'add_quantity' : $this->remark,
        ]);

        $product = Product::find($this->product_id);
        if($this->action == 'add'){
        $product->increment('quantity', $this->quantity);
        } else if($this->action == 'remove'){
            $product->decrement('quantity', $this->quantity);
        }
        

        $this->resetInputFields();
        $this->forceClose()->closeModal();
        $this->successAlert('Product Stock Updated Successfully!');
    }
}
