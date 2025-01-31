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
    public $sortColumn = 'name';
    public $sortDirection = 'asc';
    public $model;

    use LivewireAlert;
    use ModelComponentTrait;
    use WithPagination;

    public function sortByColumn($column)
    {
        if ($this->sortColumn == $column) {
            $this->sortDirection = $this->sortDirection == 'asc' ? 'desc' : 'asc';
        } else {
            $this->reset('sortDirection');
            $this->sortColumn = $column;
        }
    }
    
    public function render()
    {
        $banners = $this->getData2(new Banner());
        return view('livewire.admin.banner-component', compact('banners'))->layout('layouts.admin');
    }

    public function delete_dialog($id, $model){
        $this->emit("openModal", "admin.delete-confirmation-dialog", ["id" => $id, "model" => $model]);
    }

    public function edit($id){
        $this->emit("openModal", "admin.banner-edit", ["id" => $id]);
    }

    /*
    public function confirmDelet($id)
    {
        $prod = Banner::where('id', $id)->first();
        $image = $prod->image;

        if (Storage::disk('gcs')->exists($image)) {
                Storage::disk('gcs')->delete($image);
            /*
                Delete Multiple File like this way
                Storage::delete(['upload/test.png', 'upload/test2.png']);
            
        }
        Banner::where('id', $id)->delete();  
        $this->successAlert('Banner Deleted Successfully!');
    }
    */
}
