<?php

namespace App\Http\Livewire\Auth\Passwords;

use Livewire\Component;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Auth;

class Email extends Component
{
    /** @var string */
    public $email;

    /** @var string|null */
    public $emailSentMessage = false;

    public $recaptcha;

    protected $messages = [
        'recaptcha.captcha' => 'Captcha expired. Please refresh the page.   ',
        'recaptcha.required' => 'Captcha is required.'
    ];

    public function sendResetPasswordLink()
    {



        $this->validate([
            'email' => ['required', 'email'],
            'recaptcha' => ['required', 'captcha']
        ]);

        if (RateLimiter::tooManyAttempts('send-message:'.Auth::id(), $perMinute = 5)) {
            $seconds = RateLimiter::availableIn('send-message:'.$user->id);
            dd('You may try again in '.$seconds.' seconds.');
        }
        $response = $this->broker()->sendResetLink(['email' => $this->email]);
        
        if ($response == Password::RESET_LINK_SENT) {
            $this->emailSentMessage = trans($response);

            return;
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

    public function render()
    {
        return view('livewire.auth.passwords.email')->extends('layouts.auth');
    }
}
