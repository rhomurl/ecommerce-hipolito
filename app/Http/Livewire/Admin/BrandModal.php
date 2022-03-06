<?php

namespace App\Http\Livewire\Admin;

use Jantinnerezo\LivewireAlert\LivewireAlert;

use App\Models\Brand;
use App\Traits\ModelComponentTrait;

use LivewireUI\Modal\ModalComponent;

class BrandModal extends ModalComponent
{
    use LivewireAlert;
    use ModelComponentTrait;

    public $brand, $name, $brand_id;

    public function create(){
        $this->validate([
            'name' => 'required|regex:/[a-zA-Z0-9\s]+/|unique:brands',
        ]);

        $brand = Brand::updateOrCreate(
            ['id' => $this->brand_id],
            ['name' => $this->name]
        );
        
        //$this->emit("openModal", "admin.success-modal", ["message" => $this->brand_id ? 'Brand Updated Successfully.' : 'Brand Added Successfully']);
        $this->resetInputFields();
        $this->closeModal();
        $this->successAlert('Banner Created Successfully!');
    }

    public function render()
    {
        return view('livewire.admin.brand-modal');
    }
}
