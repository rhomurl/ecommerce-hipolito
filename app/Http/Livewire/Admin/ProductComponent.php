<?php

namespace App\Http\Livewire\Admin;

use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Support\{Str,Facades\Storage};
use App\Models\{Product,Category,Brand};
use App\Traits\ModelComponentTrait;
use Livewire\{Component, WithPagination, WithFileUploads};
use App\Services\ProductService;

class ProductComponent extends Component
{
    use LivewireAlert;
    use ModelComponentTrait;
    use WithFileUploads;
    use WithPagination;

    //https://laravel-livewire.com/docs/2.x/query-string
    protected $listeners = ['updateComponent' => 'render'];
    
    public $isOpen = 0;
    public $search = "";
    public $pagenum = 10;
    public $sortColumn = 'name';
    public $sortDirection = 'asc';

    public function sortByColumn($column)
    {
        if ($this->sortColumn == $column) {
            $this->sortDirection = $this->sortDirection == 'asc' ? 'desc' : 'asc';
        } else {
            $this->reset('sortDirection');
            $this->sortColumn = $column;
        }
    }

    public function render()
    {
        $products = Product::with('brand', 'category');
        $products = $products->search($this->search)
            ->orderBy($this->sortColumn, $this->sortDirection)
            ->paginate($this->pagenum);

        return view('livewire.admin.product-component', compact('products'))->layout('layouts.admin');
    }

    public function edit($id){
        $this->emit("openModal", "admin.product-edit", ["product" => $id]);
    }

    public function exportCsv(){

        $products = Product::with('brand', 'category')
            ->search($this->search)
            ->orderBy($this->sortColumn, $this->sortDirection)
            ->get();

        $fileName = 'products_'.now(); 

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('Product Name', 'Brand', 'Category', 'Description', 'Selling Price', 'Quantity', 'Image URL');

        $callback = function() use($products, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($products as $product) {

                $row['Product Name']  = $product->name;
                $row['Brand'] = $product->brand->name;
                $row['Category']  = $product->category->name;
                $row['Description']  = $product->description;
                $row['Selling Price']  = $product->selling_price;
                $row['Quantity']  = $product->quantity;
                $row['Image URL']  = $this->getProductURL($product->image);


                fputcsv($file, array($row['Product Name'], $row['Brand'], $row['Category'], $row['Description'], $row['Selling Price'], $row['Quantity'], $row['Image URL']));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function confirmDelete($id)
    {
        resolve(ProductService::class)->deleteProduct($id);
    }
}
