<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class EditProfile extends Component
{
    public $name, $email, $success_msg; 

    public function mount(){
        $this->name = Auth::user()->name;
        $this->email = Auth::user()->email;
    }

    public function edit(){
        $this->validate([
            'name' => 'required|regex:/[a-zA-Z0-9\s]+/',
        ]);

        $user = User::updateOrCreate(
            ['id' => Auth::user()->id],
            ['name' => $this->name]
        );
        
        $this->success_msg = 'User Profile Updated Successfully';
        //$this->resetInputFields();
    }

    private function resetInputFields(){
        $this->reset();
        $this->resetValidation();
    }

    public function render()
    {
    
        return view('livewire.user.edit-profile')->extends('layouts.user-profile');
    }
}
