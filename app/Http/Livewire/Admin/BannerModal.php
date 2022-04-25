<?php

namespace App\Http\Livewire\Admin;

use Jantinnerezo\LivewireAlert\LivewireAlert;

use App\Models\Banner;
use App\Models\Brand;
use App\Traits\ModelComponentTrait;

use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use LivewireUI\Modal\ModalComponent;

class BannerModal extends ModalComponent
{
    public $banner_id, $banner, $image, $name;

    use WithFileUploads;
    use LivewireAlert;
    use ModelComponentTrait;
    /*
    public function mount($id)
    {
        $this->banner_id = $id;
        $category = Banner::findOrFail($this->banner_id);
        $this->name = $banner->name;
        $this->image = $banner->image; 
    }*/

    public function create(){
        $this->validate([
            'name' => 'required|regex:/[a-zA-Z0-9\s]+/|unique:brands',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);


        $extension = $this->image->extension();
        $banner_name = 'banner_'.sha1(date('Y-m-d H:i:s').uniqid()).'.'.$extension;
        
        $banner = Banner::updateOrCreate(
            ['id' => $this->banner_id],
            [
                'name' => $this->name,
                'image' => $this->image->storeAs('images/banners', $banner_name , 'gcs')
            ]
        );
        //$this->emit("openModal", "admin.success-modal", ["message" => $this->banner_id ? 'Banner Updated Successfully.' : 'Banner Added Successfully']);
        $this->resetInputFields();
        $this->closeModal();
        $message = $this->banner_id ? 'Banner Updated Successfully.' : 'Banner Added Successfully';
        $this->successAlert($message);
    }

    public function render()
    {
        return view('livewire.admin.banner-modal');
    }
}
