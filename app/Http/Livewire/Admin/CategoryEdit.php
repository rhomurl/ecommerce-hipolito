<?php

namespace App\Http\Livewire\Admin;

use Jantinnerezo\LivewireAlert\LivewireAlert;
use App\Services\CategoryService;
use App\Traits\ModelComponentTrait;
use App\Models\Category;
use LivewireUI\Modal\ModalComponent;

class CategoryEdit extends ModalComponent
{
    use LivewireAlert;
    use ModelComponentTrait;

    public $category, $name, $category_id, $slug;

    protected $rules = [
        'name' => 'required|max:30|regex:/[a-zA-Z0-9\s]+/|unique:categories',
    ];

    public function mount($id)
    {
        $this->category_id = $id;
        $category = Category::findOrFail($this->category_id);
        $this->name = $category->name;
        $this->slug = $category->slug;
    }

    public function edit(CategoryService $category){
        $this->validate();
        $category->edit($this->category_id,$this->name); 
        
        $this->resetInputFields();
        $this->closeModal();
        $this->successAlert('Category Updated Successfully!');
    }

    public function render()
    {
        return view('livewire.admin.category-edit');
    }
/*
    public static function closeModalOnEscape(): bool
    {
        return false;
    }
*/
    
}
