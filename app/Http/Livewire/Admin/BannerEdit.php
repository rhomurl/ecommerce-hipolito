<?php

namespace App\Http\Livewire\Admin;

use Jantinnerezo\LivewireAlert\LivewireAlert;

use App\Models\Banner;
use App\Traits\ModelComponentTrait;

use Illuminate\Support\Facades\Storage;

use LivewireUI\Modal\ModalComponent;
//use Livewire\WithFileUploads;

class BannerEdit extends ModalComponent
{
    use LivewireAlert;
    use ModelComponentTrait;
    //use WithFileUploads;

    public $name, $banner_id;

    public function mount($id){
        $this->banner_id = $id;
        $banner = Banner::findOrFail($this->banner_id);
        $this->name = $banner->name;
    }

    public function create(){
        $this->validate([
            'name' => 'required|regex:/[a-zA-Z0-9\s]+/',
        ]);

        $product = Banner::updateOrCreate(['id' => $this->banner_id],
            [
                'name' =>  $this->name,
            ]
        );
        //$this->emit("openModal", "admin.success-modal", ["message" => $this->banner_id ? 'Banner Updated Successfully.' : 'Banner Added Successfully']);
        $this->resetInputFields();
        $this->closeModal();
        $this->successAlert('Banner Updated Successfully!'); 
    }

    public function render()
    {
        return view('livewire.admin.banner-edit');
    }
}
