<?php

namespace App\Http\Livewire\Admin;

use App\Models\Banner;
use App\Traits\ModelComponentTrait;
use Illuminate\Support\Facades\Storage;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithFileUploads;
use LivewireUI\Modal\ModalComponent;

class BannerEditImage extends ModalComponent
{
    use LivewireAlert, ModelComponentTrait, WithFileUploads;
    
    public $banner_id, $image;

    public function mount(Banner $banner){
        $this->banner_id = $banner->id;
        $this->image = $banner->image;
    }

    public function create(){
        $this->validate([
            'image' => 'required|image|mimes:jpeg,jpg,png|max:2048',
        ]);

        $bannerxx = Banner::findOrFail($this->banner_id);

        $extension = $this->image->extension();
        $banner_name = 'banner_'.sha1(date('Y-m-d H:i:s').uniqid()).'.'.$extension;
        
        if (Storage::disk('gcs')->exists($bannerxx->image)) {
                Storage::disk('gcs')->delete($bannerxx->image);
            /*
                Delete Multiple Files 
                Storage::delete(['upload/test.png', 'upload/test2.png']);
            */
        }

        $banner = Banner::updateOrCreate(['id' => $this->banner_id],
            [
                'image' => $this->image->storeAs('images/banners', $banner_name , 'gcs')
            ]);

        $this->resetInputFields();
        $this->forceClose()->closeModal();
        $this->successAlert('Banner Image Updated Successfully!');
    }

    public function render()
    {
        return view('livewire.admin.banner-edit-image');
    }
}
