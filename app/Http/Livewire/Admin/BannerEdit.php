<?php

namespace App\Http\Livewire\Admin;

use App\Models\Banner;
use App\Traits\ModelComponentTrait;
use Illuminate\Support\Facades\Storage;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use LivewireUI\Modal\ModalComponent;

class BannerEdit extends ModalComponent
{
    use LivewireAlert, ModelComponentTrait;

    public $name, $banner_id;

    public function mount(Banner $banner){
        $this->banner_id = $banner->id;
        $this->name = $banner->name;
    }

    public function edit(){
        $this->validate([
            'name' => 'required|regex:/[a-zA-Z0-9\s]+/',
        ]);

        $product = Banner::updateOrCreate(['id' => $this->banner_id],
            [
                'name' =>  $this->name,
            ]);

        $this->resetInputFields();
        $this->closeModal();
        $this->successAlert('Banner Updated Successfully!'); 
    }

    public function render()
    {
        return view('livewire.admin.banner-edit');
    }
}
