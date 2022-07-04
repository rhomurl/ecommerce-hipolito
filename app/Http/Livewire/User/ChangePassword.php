<?php

namespace App\Http\Livewire\User;

use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

use Livewire\Component;

class ChangePassword extends Component
{
    public $password, $new_confirm_password, $new_password, $current_password;
    public $visible1, $visible2;

    protected $messages = [
        'new_password.min' => 'New password is minimum of 8 characters.',
        'new_password.regex' => 'New password should contain at least 1 lowercase, uppercase, number, and special character.',
        'new_confirm_password.same' => 'New password and new confirm password must match.'
    ];

    public function mount(){
        $this->visible1 = $this->visible2 = false;
    }

    public function changePassword()
    {   
        $this->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => [
                'required', 
                'min:8',
                'regex:/[a-z]/', 
                'regex:/[A-Z]/', 
                'regex:/[0-9]/', 
                'regex:/[@$!%*#?&]/',
                'different:current_password'
            ],
            'new_confirm_password' => ['required', 'same:new_password'],
        ]);

        $this->visible1 = $this->visible2 = false;

        User::find(auth()->user()->id)->update(['password'=> Hash::make($this->new_password)]);
   
        session()->flash('message', 'Password Successfully Changed!');
        return redirect()->route('user.edit');
    }

    public function togglePassword1(){ $this->visible1 = !$this->visible1;}
    public function togglePassword2(){ $this->visible2 = !$this->visible2;}

    public function render()
    {
        return view('livewire.user.change-password')->extends('layouts.user-profile');
    }

}