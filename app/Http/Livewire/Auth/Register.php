<?php

namespace App\Http\Livewire\Auth;

use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Livewire\Component;

class Register extends Component
{
    /** @var string */
    public $name = '';

    /** @var string */
    public $email = '';

    /** @var string */
    public $password = '';

    /** @var string */
    public $passwordConfirmation = '';
    
    public $recaptcha;

    public $visible;

    protected $messages = [
        'password.min' => 'Password is minimum of 8 characters',
        'password.regex' => 'Password must contain at least 1 letter (small and capital), number, and special character',
        'password.same' => 'Password and new confirm password must match'
    ];

    public function mount(){
        $this->visible = false;
    }

    public function register()
    {                             
        $this->validate([
            'name' => ['required'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'min:8', 'same:passwordConfirmation'],
            'recaptcha' => ['required', 'captcha']
        ]);

        $this->visible = false;

        $user = User::create([
            'email' => $this->email,
            'name' => $this->name,
            'password' => Hash::make($this->password),
        ]);

        $user->assignRole('customer');
        event(new Registered($user));
        Auth::login($user, true);
        return redirect()->intended(route('auth.redirect'));
        //return redirect()->intended(route('home'));
    }

    public function togglePassword(){ $this->visible = !$this->visible;}

    public function render()
    {
        return view('livewire.auth.register')->extends('layouts.auth');
    }
}
