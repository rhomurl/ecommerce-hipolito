<?php

namespace App\Http\Livewire\Admin;

use Jantinnerezo\LivewireAlert\LivewireAlert;
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

    public function create(CategoryService $category){
        $this->validate();
        $category->store($this->name);
        
        $this->resetInputFields();
        $this->closeModal();
        $this->successAlert('Category Created Successfully!');
        $this->emit('updateComponent');
    }

    public function render()
    {
        return view('livewire.admin.category-modal');
    } 
}
