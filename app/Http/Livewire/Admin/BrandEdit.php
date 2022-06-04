<?php

namespace App\Http\Livewire\Admin;

use Jantinnerezo\LivewireAlert\LivewireAlert;

use App\Models\Brand;
use App\Services\BrandService;
use App\Traits\ModelComponentTrait;

use LivewireUI\Modal\ModalComponent;

class BrandEdit extends ModalComponent
{
    use LivewireAlert;
    use ModelComponentTrait;

    public $brand, $name, $brand_id, $slug;

    protected $rules = [
        'name' => 'required|regex:/[a-zA-Z0-9\s]+/|unique:brands',
    ];

    public function mount($id)
    {
        $this->brand_id = $id;
        $brand = Brand::findOrFail($this->brand_id);
        $this->name = $brand->name;
        $this->slug = $brand->slug;
    }

    public function create(BrandService $brand){
        $this->validate();
        $brand->edit($this->brand_id,$this->name); 
        
        $this->resetInputFields();
        $this->closeModal();
        $this->successAlert('Brand Edited Successfully!');
    }

    public function render()
    {
        return view('livewire.admin.brand-edit');
    }
}
