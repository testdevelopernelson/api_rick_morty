<?php



namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Support\Facades\Lang;

class ContactRequest extends FormRequest {

    /**

     * Determine if the user is authorized to make this request.

     *

     * @return bool

     */

    public function authorize() {

        return true;

    }



    /**

     * Get the validation rules that apply to the request.

     *

     * @return array

     */

    public function rules() {



        $rules = [

            'name' => 'required',

            'phone' => 'required',

            'email' => 'required|email',

            'subject' => 'required',

            'message' => 'required'



        ];



        return $rules;



    }



    public function messages() {
        return [

            'name.required' => Lang::get('register.name_required'),

            'phone.required' => Lang::get('register.phone_required'),

            'email.required' => Lang::get('register.email_required'),

            'email.email' => Lang::get('register.email_email'),

            'subject.required' => Lang::get('contact.subject'),

            'message.required' => Lang::get('contact.message')



        ];

    }



}

