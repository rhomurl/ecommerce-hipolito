<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMessageToAdminMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($emailDetail)
    {
        $this->emailDetail = $emailDetail;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.send-message-to-admin-mail')
            ->subject("Messenger Inquiry - " . "Hipolito's Hardware")
            ->replyTo($this->emailDetail['email'])     
            ->with('emailDetail', $this->emailDetail);
    }
}
