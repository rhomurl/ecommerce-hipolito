<?php

namespace App\Http\Livewire\Admin;

use App\Models\{Brand, Product};
use App\Services\ActivityLogService;
use App\Traits\ModelComponentTrait;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithPagination;
use DB;

use Livewire\Component;

class BrandComponent extends Component
{
    use LivewireAlert, ModelComponentTrait, WithPagination;

    protected $listeners = ['updateComponent' => 'render'];
    public $search = "";
    public $sortColumn = 'name';
    public $sortDirection = 'asc';
    public $model;

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
        $brands = $this->getData2(new Brand());

        return view('livewire.admin.brand-component', compact('brands'))->layout('layouts.admin');
    }

    public function delete_dialog($id, $model){
        $this->emit("openModal", "admin.delete-confirmation-dialog", ["id" => $id, "model" => $model]);
    }

    public function edit($id)
    {
        $this->emit("openModal", "admin.brand-edit", ["brand" => $id]);
    }

    /*
    public function confirmDelet(Brand $brand, ActivityLogService $activity)
    {
        $product_qty = DB::table('products')
            ->where('brand_id', $brand->id)
            ->whereNotNull('quantity')
            ->get();

        if(count($product_qty)){
            $this->errorAlert('This Brand Cannot Be Deleted!');
        }
        else{
            $attributes = $this->getAttribute1($brand);
            $activity->createLog($brand, "", $attributes, 'Deleted brand');
            $brand->delete();
            $this->successAlert('Brand Deleted Successfully!');
        }     
    }
    */

    public static function closeModalOnEscape(): bool
    {
        return true;
    }
}
