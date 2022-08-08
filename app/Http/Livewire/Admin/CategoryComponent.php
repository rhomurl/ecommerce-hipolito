<?php

namespace App\Http\Livewire\Admin;

use App\Models\{Category, Product};
use App\Services\ActivityLogService;
use App\Traits\ModelComponentTrait;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithPagination;
use DB;

use Livewire\Component;

class CategoryComponent extends Component
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

    public function delete_dialog($id, $model){
        $this->emit("openModal", "admin.delete-confirmation-dialog", ["id" => $id, "model" => $model]);
    }

    public function render()
    {
        $categories = $this->getData2(new Category());
        return view('livewire.admin.category-component', compact('categories'))->layout('layouts.admin');
    }

    public function edit($id)
    {
        $this->emit("openModal", "admin.category-edit", ["category" => $id]);
    }

/*
    public function confirmDelete(ActivityLogService $activity)
    {
        $product_qty = DB::table('products')
            ->where('category_id', $this->deleteId)
            ->whereNotNull('quantity')
            ->get();

        if(count($product_qty)){
            $this->errorAlert('This Category Cannot Be Deleted!');
        }
        else{
            $attributes = $this->getAttribute1($category);
            $activity->createLog($category, "", $attributes, 'Deleted category');
            $category->delete();
            $this->successAlert('Category Deleted Successfully!');
        }     
    }
    */

    public static function closeModalOnEscape(): bool
    {
        return true;
    }
}