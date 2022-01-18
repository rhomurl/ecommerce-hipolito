<?php

namespace App\Http\Livewire\Admin;

use App\Models\Banner;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use LivewireUI\Modal\ModalComponent;

class BannerEdit extends ModalComponent
{
    use WithFileUploads;

    public $name;

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
        $this->emit("openModal", "admin.success-modal", ["message" => $this->banner_id ? 'Banner Updated Successfully.' : 'Banner Added Successfully']);
    }

    public function render()
    {
        return view('livewire.admin.banner-edit');
    }
}
