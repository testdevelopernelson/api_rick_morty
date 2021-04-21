<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ForgotPasswordMail extends Mailable {
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $user;
    public $password_temporary;

    public function __construct($user, $password_temporary) {
        $this->user = $user;
        $this->password_temporary = $password_temporary;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
     public function build() { 
          $message = $this->to($this->user->email)
               ->subject('Recuperar contraseña '. config('app.name') . ' ['.date('d-m-Y H:i').']')
               ->view('emails.account.forgot_password'); 
          return $message;
     }
}
