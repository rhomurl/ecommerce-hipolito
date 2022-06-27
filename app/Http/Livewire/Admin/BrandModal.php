<?php

namespace App\Http\Livewire\Admin;

use Jantinnerezo\LivewireAlert\LivewireAlert;
use App\Services\BrandService;
use App\Models\Brand;
use App\Traits\ModelComponentTrait;
use LivewireUI\Modal\ModalComponent;

class BrandModal extends ModalComponent
{
    use LivewireAlert;
    use ModelComponentTrait;

    public $brand, $name, $brand_id;

    protected $rules = [
        'name' => 'required|max:30|regex:/[a-zA-Z0-9\s]+/|unique:brands',
    ];

    public function create(BrandService $brand){
        $this->validate();
        $brand->store($this->name);
        
        $this->resetInputFields();
        $this->closeModal();
        $this->successAlert('Banner Created Successfully!');
        $this->emit('updateComponent');
    }

    public function render()
    {
        return view('livewire.admin.brand-modal');
    }
}
