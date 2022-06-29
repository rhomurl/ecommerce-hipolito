<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use App\Services\ActivityLogService;
use App\Services\CategoryService;
use App\Traits\ModelComponentTrait;
use Jantinnerezo\LivewireAlert\LivewireAlert;

use LivewireUI\Modal\ModalComponent;

class CategoryEdit extends ModalComponent
{
    use LivewireAlert;
    use ModelComponentTrait;

    public $category, $name, $category_id, $slug, $old;

    protected $rules = [
        'name' => 'required|max:30|regex:/[a-zA-Z0-9\s]+/|unique:categories',
    ];

    public function mount(Category $category)
    {
        $this->old = [
            ['name' => $category->name, 'slug' => $category->slug]
        ];

        $this->category_id = $category->id;
        $this->name = $category->name;
        $this->slug = $category->slug;
    }

    public function edit(CategoryService $category, ActivityLogService $activity){
        $this->validate();

        $category = $category->edit($this->category_id, $this->name); 
        $old = $this->old;
        $attributes = [
            ['name' => $category->name,'slug' => $category->slug]
        ];

        $activity->createLog($category, $old, $attributes, 'Updated category');
        
        $this->resetInputFields();
        $this->closeModal();
        $this->successAlert('Category Updated Successfully!');
    }

    public function render()
    {
        return view('livewire.admin.category-edit');
    }
}
