<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DevolutionCustomerMail extends Mailable {
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
        $message = $this->to($this->user->email)
           	->subject('Devolución de producto '. config('app.name') . ' ['.date('d-m-Y H:i').']')
           	->view('emails.account.devolution_customer');
        return $message;
    }
}
