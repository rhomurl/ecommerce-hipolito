<?php

namespace App\Http\Livewire\Admin;

use App\Models\ProductInventory;
use App\Services\ActivityLogService;
use App\Traits\ModelComponentTrait;
use Carbon\Carbon;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use LivewireUI\Modal\ModalComponent;

class ProductInventoryEdit extends ModalComponent
{
    use ModelComponentTrait, LivewireAlert;
    public $updated_received, $inventory_id, $product_name, $supplier, $product_cost, $selling_price, $starting_stock, $reorder_level, $old, $quantity;

    protected $rules = [
        'supplier' => 'required|min:5|max:60|regex:/^[a-zA-ZÑñ.\s]+$/',
        'product_cost' => 'required|numeric|min:0|max:1000000.00|lt:selling_price',
        'reorder_level' => 'required|integer|min:0|max:999999|lt:starting_stock',
    ];

    public function mount(ProductInventory $inventory)
    {
        $this->old = [
            [
                'supplier' => $inventory->supplier,
                'product_cost' => $inventory->product_cost,
                'reorder_level' => $inventory->reorder_level,
            ]
        ];


        $this->inventory_id = $inventory->id;
        $this->product_id = $inventory->product->id;
        $this->product_name = $inventory->product->name;
        $this->supplier = $inventory->supplier;
        $this->product_cost = $inventory->product_cost;
        $this->selling_price = $inventory->product->selling_price;
        $this->starting_stock = $inventory->starting_stock;
        $this->quantity = $inventory->product->quantity;
        $this->reorder_level = $inventory->reorder_level;
        $this->created_at = Carbon::parse($inventory->created_at)->format('Y-m-d');

    }

    public function editStock($id){
        $this->emit("openModal", "admin.product-stock-edit", ["product" => $id]);
    }

    public function edit(ActivityLogService $activity)
    {
        $this->validate(); 

        $product_inventory = ProductInventory::updateOrCreate(['id' => $this->inventory_id],
        [
            'supplier' => $this->supplier,
            'product_cost' => $this->product_cost,
            'reorder_level' => $this->reorder_level,
        ]);

        $old = $this->old;
        $attributes = [
            [
                'supplier' => $product_inventory->supplier,
                'product_cost' => $product_inventory->product_cost,
                'reorder_level' => $product_inventory->reorder_level,
            ]
        ];
        $activity->createLog($product_inventory, $old, $attributes, 'Updated product inventory');

        $this->resetInputFields();
        $this->closeModal();
        $this->successAlert('Product Inventory Updated Successfully!');
    }

    public function render()
    {
        return view('livewire.admin.product-inventory-edit');
    }
}
