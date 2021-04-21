<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ChangeStatusDevolutionMail extends Mailable {
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $data;

    public function __construct($data) {
        $this->data = $data;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build() {  
        // dd($this->data);      
        $message = $this->to($this->data['email'])
            ->subject('Actualización estado de la devolución '. config('app.name') . ' ['.date('d-m-Y H:i').']')
            ->view('emails.account.change_status_devolution');
          //   dd($message);
        return $message;
    }
}
