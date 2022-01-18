<?php

namespace App\Http\Livewire\Admin;

use App\Models\Brand;
use LivewireUI\Modal\ModalComponent;

class BrandEdit extends ModalComponent
{
    public $brand, $name, $brand_id, $slug;

    public function mount($id)
    {
        $this->brand_id = $id;
        $brand = Brand::findOrFail($this->brand_id);
        $this->name = $brand->name;
        $this->slug = $brand->slug;
    }


    public function create(){
        $this->validate([
            'name' => 'required|regex:/[a-zA-Z0-9\s]+/|unique:brands,name,'.$this->brand_id.'',
        ]);

        $brand = Brand::updateOrCreate(
            ['id' => $this->brand_id],
            ['name' => $this->name]
        );
        
        
        $this->emit("openModal", "admin.success-modal", ["message" => $this->brand_id ? 'Brand Updated Successfully.' : 'Brand Added Successfully']);
        $this->resetInputFields();
    }

    private function resetInputFields(){
        $this->reset();
        $this->resetValidation();
    }

    public function render()
    {
        return view('livewire.admin.brand-edit');
    }
}
