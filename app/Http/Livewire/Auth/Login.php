<?php

namespace App\Http\Livewire\Auth;

use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Session;

class Login extends Component
{
    /** @var string */
    public $email = '';

    /** @var string */
    public $password = '';

    /** @var bool */
    public $remember = false;

    public $visible;

    protected $rules = [
        'email' => ['required', 'email'],
        'password' => ['required'],
    ];

    public function mount(){
        $this->error = Session::get('error');
        $this->visible = false;
    }

    public function authenticate()
    {
        $this->validate();

        if (!Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
            $this->addError('email', trans('auth.failed'));
            return;
        }

        return redirect()->intended(route('auth.redirect'));
    }

    public function togglePassword()
    {
        $this->visible = !$this->visible;
    }
    
    public function render()
    {
        return view('livewire.auth.login')->extends('layouts.auth');
    }
}
