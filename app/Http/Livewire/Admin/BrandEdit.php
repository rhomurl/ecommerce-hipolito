<?php

namespace App\Http\Livewire\Admin;

use App\Models\Brand;
use App\Services\ActivityLogService;
use App\Services\BrandService;
use App\Traits\ModelComponentTrait;
use Jantinnerezo\LivewireAlert\LivewireAlert;

use LivewireUI\Modal\ModalComponent;

class BrandEdit extends ModalComponent
{
    use LivewireAlert;
    use ModelComponentTrait;

    public $brand, $name, $brand_id, $slug, $old;

    protected $rules = [
        'name' => 'required|max:30|regex:/[a-zA-Z0-9\s]+/|unique:brands',
    ];

    public function mount(Brand $brand)
    {
        $this->old = [
            ['name' => $brand->name, 'slug' => $brand->slug]
        ];
        
        $this->brand_id = $brand->id;
        $this->name = $brand->name;
        $this->slug = $brand->slug;
    }

    public function edit(BrandService $brand, ActivityLogService $activity){
        $this->validate();

        $brand = $brand->edit($this->brand_id, $this->name);
        $old = $this->old;
        $attributes = [
            ['name' => $brand->name,'slug' => $brand->slug]
        ];
        
        $activity->createLog($brand, $old, $attributes, 'Updated brand');

        $this->resetInputFields();
        $this->closeModal();
        $this->successAlert('Brand Edited Successfully!');
    }

    public function render()
    {
        return view('livewire.admin.brand-edit');
    }
}
