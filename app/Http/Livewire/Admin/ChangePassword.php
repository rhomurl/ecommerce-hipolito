<?php

namespace App\Http\Livewire\Admin;

use Jantinnerezo\LivewireAlert\LivewireAlert;
use App\Traits\ModelComponentTrait;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

use LivewireUI\Modal\ModalComponent;

class ChangePassword extends ModalComponent
{
    use LivewireAlert;
    use ModelComponentTrait;

    public $password, $new_confirm_password, $new_password, $current_password;

    protected $messages = [
        'new_password.min' => 'New password is minimum of 8 characters',
        'new_password.regex' => 'New password must contain at least 1 letter (small and capital), number, and special character',
        'new_confirm_password.same' => 'New password and new confirm password must match'
    ];

    public function render()
    {
        return view('livewire.admin.change-password');
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
                'regex:/[`^@$!%*#?&]/',
                'different:current_password'
            ],
            'new_confirm_password' => ['required', 'same:new_password'],
        ]);

        User::find(auth()->user()->id)->update(['password'=> Hash::make($this->new_password)]);
   
        $this->closeModal();
        $this->successAlert('Password Successfully Updated!');
    }

}
