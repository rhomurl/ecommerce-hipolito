<?php

namespace App\Http\Livewire\Admin;

use Jantinnerezo\LivewireAlert\LivewireAlert;
use App\Models\Category;
use LivewireUI\Modal\ModalComponent;

class CategoryModal extends ModalComponent
{
    use LivewireAlert;

    public $category, $name, $category_id, $type, $otherModal;

    public function create(){
        $this->validate([
            'name' => 'required|regex:/[a-zA-Z0-9\s]+/|unique:categories',
        ]);

        /*$category = Category::updateOrCreate(
            ['id' => $this->category_id],
            [
                'name' => $this->name, 
            ]
        );*/
        $category = Category::create([
            'name' => $this->name, 
        ]);

        
        //$this->emit("openModal", "admin.success-modal", ["message" => $this->category_id ? 'Category Updated Successfully.' : 'Category Added Successfully']);
        $this->resetInputFields();
        $this->closeModal();

        $this->alert('success', 'Category Created Successfully!', [
            'position' => 'center',
            'timer' => '1500',
            'toast' => false,
            'timerProgressBar' => true,
            'width' => '600',
           ]);
        $this->emit('updateComponent');
    }

    private function resetInputFields(){
        $this->reset();
        $this->resetValidation();
    }

    public function render()
    {
        return view('livewire.admin.category-modal');
    }
/*
    public static function closeModalOnEscape(): bool
    {
        return false;
    }
*/
    
}
