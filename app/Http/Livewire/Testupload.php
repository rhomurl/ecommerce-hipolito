<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;
use Livewire\Component;

class Testupload extends Component
{
    use WithFileUploads;
    
    public $photo;

    public function updatedPhoto()
    {
        $this->validate([
            'photo' => 'image|max:1024',
        ]);
    }

    public function render()
    {

        //$date = Carbon::now()->subDays(3);
        //$users = User::where('created_at', '>=', $date)->get();


        return view('livewire.testupload')->layout('layouts.admin');
    }


}
