<?php

namespace App\Http\Livewire\Admin;

use Jantinnerezo\LivewireAlert\LivewireAlert;
use App\Services\ActivityLogService;
use App\Services\CategoryService;
use App\Models\Category;
use App\Traits\ModelComponentTrait;
use LivewireUI\Modal\ModalComponent;

class CategoryModal extends ModalComponent
{
    use LivewireAlert;
    use ModelComponentTrait;

    public $category, $name, $category_id;

    protected $rules = [
        'name' => 'required|max:30|regex:/[a-zA-Z0-9\s]+/|unique:categories',
    ];

    public function create(CategoryService $category, ActivityLogService $activity)
    {
        $this->validate();

        $category = $category->store($this->name);
        $attributes = $this->getAttribute1($category);
        $activity->createLog($category, "", $attributes, 'Created category');
        
        $this->resetInputFields();
        $this->closeModal();
        $this->successAlert('Category Created Successfully!');
    }

    public function render()
    {
        return view('livewire.admin.category-modal');
    } 
}
