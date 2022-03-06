<?php

namespace App\Http\Livewire\Admin;

use Jantinnerezo\LivewireAlert\LivewireAlert;
use App\Traits\ModelComponentTrait;
use App\Models\Category;
use LivewireUI\Modal\ModalComponent;

class CategoryEdit extends ModalComponent
{
    use LivewireAlert;
    use ModelComponentTrait;

    public $category, $name, $category_id, $slug, $type;
    //public $msg = "199";

    public function mount($id)
    {
            $this->category_id = $id;
            $category = Category::findOrFail($this->category_id);
            $this->name = $category->name;
            $this->slug = $category->slug;
            $this->type = $category->type;
    }

    public function create(){
        $this->validate([
            'name' => 'required|regex:/[a-zA-Z0-9\s]+/|unique:categories,name,'.$this->category_id.'',
            //'type' => 'string|required'
        ]);

        $category = Category::updateOrCreate(
            ['id' => $this->category_id],
            [
                'name' => $this->name,
                //'type' => $this->type
            ]
        );
        
        //$this->emit("openModal", "admin.success-modal", ["message" => $this->category_id ? 'Category Updated Successfully.' : 'Category Added Successfully']);
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
