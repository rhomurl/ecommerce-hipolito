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
    public $updated_received, $inventory_id, $product_name, $supplier, $product_cost, $selling_price, $starting_stock, $reorder_level, $received_at, $old;

    protected $rules = [
        'supplier' => 'required:regex:/^[a-zA-ZÑñ.\s]+$/',
        'product_cost' => 'required|numeric|min:0|max:1000000.00|lt:selling_price',
        'reorder_level' => 'required|integer|min:0|max:999999|lt:starting_stock',
        'received_at' => 'required|date|before:tomorrow|after:2000-01-01'
    ];

    protected $messages = [
        'received_at.after' => 'Date received must be a date after 1998-01-01',       
        'received_at.before' => 'Date received must be a date before tomorrow'
    ];

    public function mount(ProductInventory $inventory)
    {
        $this->old = [
            [
                'supplier' => $inventory->supplier,
                'product_cost' => $inventory->product_cost,
                'reorder_level' => $inventory->reorder_level,
                'received_at' => $inventory->received_at,
            ]
        ];


        $this->inventory_id = $inventory->id;
        $this->product_name = $inventory->product->name;
        $this->supplier = $inventory->supplier;
        $this->product_cost = $inventory->product_cost;
        $this->selling_price = $inventory->product->selling_price;
        $this->starting_stock = $inventory->starting_stock;
        $this->quantity = $inventory->product->quantity;
        $this->reorder_level = $inventory->reorder_level;
        $this->received_at = Carbon::parse($inventory->received_at)->format('Y-m-d');
        //Carbon::createFromFormat('Y-m-d', $this->received_at)->toDateString();

    }

    public function edit(ActivityLogService $activity)
    {
        $this->validate(); 

        $product_inventory = ProductInventory::updateOrCreate(['id' => $this->inventory_id],
        [
            'supplier' => $this->supplier,
            'product_cost' => $this->product_cost,
            'reorder_level' => $this->reorder_level,
            'received_at' => $this->received_at,
        ]);

        $old = $this->old;
        $attributes = [
            [
                'supplier' => $product_inventory->supplier,
                'product_cost' => $product_inventory->product_cost,
                'reorder_level' => $product_inventory->reorder_level,
                'received_at' => $product_inventory->received_at,
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
