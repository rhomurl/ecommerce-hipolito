<?php

namespace App\Http\Livewire\Admin;

use App\Models\Banner;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use LivewireUI\Modal\ModalComponent;

class BannerModal extends ModalComponent
{
    public $banner_id, $banner, $image, $name;

    use WithFileUploads;
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

        $banner = Banner::updateOrCreate(
            ['id' => $this->banner_id],
            [
                'name' => $this->name,
                'image' => $this->image->store('images/banners', 'public')
            ]
        );
        
        $this->emit("openModal", "admin.success-modal", ["message" => $this->banner_id ? 'Banner Updated Successfully.' : 'Banner Added Successfully']);
        $this->resetInputFields();
    }

    private function resetInputFields(){
        $this->reset();
        $this->resetValidation();
    }

    public function render()
    {
        return view('livewire.admin.banner-modal');
    }
}
