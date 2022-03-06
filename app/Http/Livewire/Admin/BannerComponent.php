<?php

namespace App\Http\Livewire\Admin;

use Jantinnerezo\LivewireAlert\LivewireAlert;

use Illuminate\Support\Facades\Storage;

use App\Models\Banner;
use App\Traits\ModelComponentTrait;

use Livewire\WithPagination;
use Livewire\Component;

class BannerComponent extends Component
{
    protected $listeners = ['updateComponent' => 'render'];
    public $search = "";

    use LivewireAlert;
    use ModelComponentTrait;
    use WithPagination;

    public function render()
    {
        $banners = $this->getData(new Banner());
        return view('livewire.admin.banner-component', compact('banners'))->layout('layouts.admin');
    }

    public function edit($id){
        $this->emit("openModal", "admin.banner-edit", ["id" => $id]);
    }

    public function confirmDelete($id)
    {
        $prod = Banner::where('id', $id)->first();
        $image = $prod->image;

        if(Storage::exists('public/' . $image)){
            Storage::delete('public/' . $image);
            /*
                Delete Multiple File like this way
                Storage::delete(['upload/test.png', 'upload/test2.png']);
            */
        }else{
            //dd('File does not exists.');
        }
        Banner::where('id', $id)->delete();  
        $this->successAlert('Banner Deleted Successfully!');
        //$this->emit("openModal", "admin.success-modal", ["message" => 'Banner Deleted Successfully']); 
    }
}
