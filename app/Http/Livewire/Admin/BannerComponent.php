<?php

namespace App\Http\Livewire\Admin;

use Livewire\WithPagination;
use App\Models\Banner;
use Livewire\Component;

class BannerComponent extends Component
{
    protected $listeners = ['updateComponent' => 'render'];
    public $search = "";

    use WithPagination;

    public function render()
    {
        $banners = Banner::where('name', 'like', '%'.$this->search.'%')->paginate(10);
        return view('livewire.admin.banner-component', compact('banners'))->layout('layouts.admin');
    }

    public function edit($id){
        $this->emit("openModal", "admin.banner-edit", ["id" => $id]);
    }

    public function confirmDelete($id)
    {
        Banner::where('id', $id)->delete();  
        $this->emit("openModal", "admin.success-modal", ["message" => 'Banner Deleted Successfully']); 
    }
}
