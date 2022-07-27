<?php

namespace App\Http\Livewire\Auth\Passwords;

use App\Providers\RouteServiceProvider;
use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;

class Reset extends Component
{
    /** @var string */
    public $token;

    /** @var string */
    public $email;

    /** @var string */
    public $password;

    /** @var string */
    public $passwordConfirmation;

    public $visible;

    protected $messages = [
        'password.min' => 'Password is minimum of 8 characters.',
        'password.regex' => 'Password should contain at least 1 lowercase, uppercase, number, and special character.',
        'password.same' => 'Password and confirm password must match.'
    ];

    public function mount($token)
    {
        $this->email = request()->query('email', '');
        $this->token = $token;
        $this->visible = false;
    }

    public function resetPassword()
    {
        $this->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => [
                'required', 
                'min:8',
                'regex:/[a-z]/', 
                'regex:/[A-Z]/', 
                'regex:/[0-9]/', 
                'regex:/[@$!%*#?&]/',
                'same:passwordConfirmation'
            ],
            //'password' => 'required|min:8|same:passwordConfirmation',
        ]);

        $response = $this->broker()->reset(
            [
                'token' => $this->token,
                'email' => $this->email,
                'password' => $this->password
            ],
            function ($user, $password) {
                $user->password = Hash::make($password);

                $user->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));

                $this->guard()->login($user);
            }
        );

        if ($response == Password::PASSWORD_RESET) {
            session()->flash(trans($response));

            return redirect(route('home'));
        }

        $this->addError('email', trans($response));
    }

    /**
     * Get the broker to be used during password reset.
     *
     * @return \Illuminate\Contracts\Auth\PasswordBroker
     */
    public function broker()
    {
        return Password::broker();
    }

    /**
     * Get the guard to be used during password reset.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard();
    }

    public function togglePassword(){ $this->visible = !$this->visible;}
    public function updatedPassword(){
        $this->resetValidation();
    }

    public function render()
    {
        return view('livewire.auth.passwords.reset')->extends('layouts.auth');
    }
}
