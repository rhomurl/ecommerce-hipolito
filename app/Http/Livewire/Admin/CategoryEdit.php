<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use LivewireUI\Modal\ModalComponent;

class CategoryEdit extends ModalComponent
{
    public $category, $name, $category_id, $slug, $type;

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
            'type' => 'string|required'
        ]);

        $category = Category::updateOrCreate(
            ['id' => $this->category_id],
            [
                'name' => $this->name,
                'type' => $this->type
            ]
        );
        
        
        $this->emit("openModal", "admin.success-modal", ["message" => $this->category_id ? 'Category Updated Successfully.' : 'Category Added Successfully']);
        $this->resetInputFields();
 
    }

    private function resetInputFields(){
        $this->reset();
        $this->resetValidation();
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
