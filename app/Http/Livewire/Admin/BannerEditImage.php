<?php

namespace App\Http\Livewire\Admin;

use App\Models\Banner;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use LivewireUI\Modal\ModalComponent;

class BannerEditImage extends ModalComponent
{
    use WithFileUploads;

    public $image;

    public function mount($id){
        $this->banner_id = $id;
        $banner = Banner::findOrFail($this->banner_id);
        $this->image = $banner->image;
    }

    public function create(){
        $this->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $bannerxx = Banner::findOrFail($this->banner_id);
        
        if(Storage::exists('public/' . $bannerxx->image)){
            Storage::delete('public/' . $bannerxx->image);
            /*
                Delete Multiple File like this way
                Storage::delete(['upload/test.png', 'upload/test2.png']);
            */
        }else{
            //dd('File does not exists.');
        }

        $banner = Banner::updateOrCreate(['id' => $this->banner_id],
            [
                'image' =>  $this->image->store('images/banners', 'public'),
            ]
        );
        $this->emit("openModal", "admin.success-modal", ["message" => $this->banner_id ? 'Banner Updated Successfully.' : 'Banner Added Successfully']);
    }


    public function render()
    {
        return view('livewire.admin.banner-edit-image');
    }
}
