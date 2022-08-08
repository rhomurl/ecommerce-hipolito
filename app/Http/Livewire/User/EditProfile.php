<?php

namespace App\Http\Livewire\User;

use Session;    
use App\Models\User;
use App\Services\ActivityLogService;
use App\Traits\ModelComponentTrait;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class EditProfile extends Component
{
    use ModelComponentTrait;

    public $name, $email, $success_msg, $old; 

    protected $messages = [
        'name.regex' => 'Name must only contain letters'
    ];

    public function mount(){
        $this->success_msg = Session::get('message');
        $this->name = Auth::user()->name;
        $this->email = Auth::user()->email;
        $this->old = [
            ['email' => Auth::user()->email]
        ];
    }

    public function edit(ActivityLogService $activity){
        $this->validate([
            //'name' => 'required|regex:/^[a-zA-ZÑñ.\s]+$/',
            'email' => 'required|email'
        ]);

        $user = User::updateOrCreate(
            ['id' => Auth::user()->id],
            ['email' => $this->email]
        );

        if ($user->wasChanged('email')) {
            $old = $this->old;
            $attributes = [
                ['email' => $this->email]
            ];
            $activity->createLog($user, $old, $attributes, 'Updated Email');

            $user->email_verified_at = null;
            $user->save();
            event(new Registered($user));
        }

        
        
        session()->flash('message', 'User Profile Updated Successfully');
        return redirect()->route('user.edit');
        
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
