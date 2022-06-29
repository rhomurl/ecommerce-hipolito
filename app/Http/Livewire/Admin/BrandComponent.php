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

    public function render()
    {
        $brands = $this->getData(new Brand());
        return view('livewire.admin.brand-component', compact('brands'))->layout('layouts.admin');
    }

    public function edit($id)
    {
        $this->emit("openModal", "admin.brand-edit", ["brand" => $id]);
    }

    public function confirmDelete(Brand $brand, ActivityLogService $activity)
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

    public static function closeModalOnEscape(): bool
    {
        return true;
    }
}
