<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|min:2|max:100',
            'email' => 'required|email',
            'phone' => 'required|min:6|max:12',
            'subject' => 'required|string|min:2|max:100',
            'message' => 'required|string|min:5|max:1000',
            'g-recaptcha-response' => 'required|captcha',
        ];
    }
}
