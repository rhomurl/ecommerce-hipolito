<?php

namespace App\Http\Livewire\Admin;

use Jantinnerezo\LivewireAlert\LivewireAlert;

use App\Models\Brand;
use App\Traits\ModelComponentTrait;

use LivewireUI\Modal\ModalComponent;

class BrandEdit extends ModalComponent
{
    use LivewireAlert;
    use ModelComponentTrait;

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

        $brand = Brand::updateOrCreate(['id' => $this->brand_id],
            [
                'name' => $this->name
            ]
        );
        
        //$this->emit("openModal", "admin.success-modal", ["message" => $this->brand_id ? 'Brand Updated Successfully.' : 'Brand Added Successfully']);
        $this->resetInputFields();
        $this->closeModal();
        $this->successAlert('Brand Edited Successfully!');
    }

    public function render()
    {
        return view('livewire.admin.brand-edit');
    }
}
