<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DevolutionShopMail extends Mailable {
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $data_mail;

    public function __construct($data_mail) {
        $this->data_mail = $data_mail;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build() {    
        // dd($this->data_mail);
        $message = $this->to($this->getTo(config('settings.email_devolutions')))
           	->subject('Devolución de producto '. config('app.name') . ' ['.date('d-m-Y H:i').']')
           	->view('emails.account.devolution_shop');
           	if($this->data_mail['file'] != null) {
           		$file = $this->data_mail['file'];
                $message->attach($file->getRealPath(), array(
                    'as' => $file->getClientOriginalName(),     
                    'mime' => $file->getMimeType())
                );
              }
        return $message;
    }

    private function getTo($array_emails){
        $email=str_replace(' ', '', $array_emails);
        $array = explode(',', $email);
        return $array;
      }
}
