<?php

namespace App\Http\Livewire\Admin;

use Jantinnerezo\LivewireAlert\LivewireAlert;
use App\Services\BrandService;
use App\Services\ActivityLogService;
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

    public function create(BrandService $brand, ActivityLogService $activity){
        $this->validate();

        $brand = $brand->store($this->name);
        $activity->createLog($brand, 'Created brand');

        $this->resetInputFields();
        $this->closeModal();
        $this->successAlert('Banner Created Successfully!');
    }

    public function render()
    {
        return view('livewire.admin.brand-modal');
    }
}
