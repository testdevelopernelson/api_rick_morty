<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserRegisteredMail extends Mailable {
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $user;

    public function __construct($user) {
        $this->user = $user;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build() {    
        // dd($this->user);
        $message = $this->to($this->user->email)
           ->subject('Bienvenido a '. config('app.name') . ' ['.date('d-m-Y H:i').']')
           ->view('emails.account.message_welcome_user_registered');
        return $message;
    }
}
