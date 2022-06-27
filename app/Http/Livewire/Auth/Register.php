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
        'name.regex' => 'Name cannot contain special characters',
        'password.min' => 'Password is minimum of 8 characters',
        'password.regex' => 'Password should contain at least 1 lowercase, uppercase, number, and special character',
        'password.same' => 'Password and confirm password must match',
        'recaptcha.captcha' => 'Captcha expired. Please refresh the page.',
        'recaptcha.required' => 'Captcha is required'
    ];

    public function mount(){
        $this->visible = false;
    }

    public function register()
    {                             
        $this->validate([
            'name' => ['required', 'regex:/^[a-zA-ZÑñ.\s]+$/'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'min:8', 'regex:/[a-z]/', 'regex:/[A-Z]/', 'regex:/[0-9]/', 'regex:/[@$!%*#?&]/','same:passwordConfirmation'],
            'passwordConfirmation' => ['required'],
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
