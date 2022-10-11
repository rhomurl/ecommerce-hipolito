<?php

namespace App\Http\Livewire\Admin;

use App\Models\ProductInventory;
use App\Traits\ModelComponentTrait;

use Jantinnerezo\LivewireAlert\LivewireAlert;

use Livewire\{Component, WithPagination};

class ProductInventoryLow extends Component
{
    use ModelComponentTrait;
    use LivewireAlert;
    use WithPagination;

    protected $listeners = [
        'updateComponent' => 'render',
        'updateValue' => 'mount'
    ];

    public $search;
    public $paginate = 10;
    public $sortColumn = 'id';
    public $sortDirection = 'asc';

    public function mount(){
        $this->all_count = ProductInventory::count();
        $this->low_count = ProductInventory::where('status', 'REORDER')->count();
    }

    public function sortByColumn($column)
    {
        if ($this->sortColumn == $column) {
            $this->sortDirection = $this->sortDirection == 'asc' ? 'desc' : 'asc';
        } else {
            $this->reset('sortDirection');
            $this->sortColumn = $column;
        }
    }

    public function edit($id)
    {
        $this->emit("openModal", "admin.product-inventory-edit", ["inventory" => $id]);
    }

    public function exportCsv(){

        $inventories = ProductInventory::with('product')
        ->search($this->search) //['supplier', 'product_cost', 'starting_stock', 'reorder_level', 'product.name']
        ->orderBy($this->sortColumn, $this->sortDirection)
        ->where('status', 'REORDER')
        ->get();

        $fileName = 'product_inventory_'.now(); 

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('Product Name', 'Supplier', 'Product Cost', 'Starting Stock', 'Current Stock', 'Reorder Level', 'Created At', 'Status');

        $callback = function() use($inventories, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($inventories as $inventory) {

                if($inventory->reorder_level >= $inventory->product->quantity )
                {
                    $row['Status'] = 'Reorder';
                }else{
                    $row['Status'] = 'Active';
                }
                $row['Product Name']  = $inventory->product->name;
                $row['Supplier'] = $inventory->supplier;
                $row['Product Cost']  = $inventory->product_cost;
                $row['Starting Stock']  = $inventory->starting_stock;
                $row['Current Stock']  = $inventory->product->quantity;
                $row['Reorder Level']  = $inventory->reorder_level;
                $row['Created At']  = $inventory->created_at;
                //$row['Status']  = $inventory->reorder_level;

                fputcsv($file, array($row['Product Name'], $row['Supplier'], $row['Product Cost'], $row['Starting Stock'], $row['Current Stock'], $row['Reorder Level'], $row['Created At'], $row['Status']));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
    

    public function render()
    {
        $inventories = ProductInventory::groupBy('product_id')
            ->search($this->search)
            ->where('status', 'REORDER')
            ->orderBy($this->sortColumn, $this->sortDirection)
            ->paginate($this->paginate);

        return view('livewire.admin.product-inventory-low', compact('inventories'))->layout('layouts.admin');
    }
}
