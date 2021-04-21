<?php



namespace App\Listeners;



use App\Mail\UserRegisteredMail;
use Illuminate\Support\Facades\Mail;



class UserRegistered {

    /**

     * Create the event listener.

     *

     * @return void

     */

    public function __construct() {

        //

    }



    /**

     * Handle the event.

     *

     * @param  object  $event

     * @return void

     */

    public function handle($event) {
        try {
            Mail::queue(new UserRegisteredMail($event->user));
        } catch (\Exception $event) {
        	
        }

    }

}

