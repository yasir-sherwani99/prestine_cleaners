<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookingFormRequest extends FormRequest
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
            'cleaning_area_post_code' => 'required|min:10|max:225',
            'service' => 'required',
            'cleaning_start_date' => 'required',
            'cleaning_start_time' => 'required',
            'customer' => 'nullable',
            'login_email' => 'nullable|email',
            'login_password' => 'nullable|string',
            'complete_name' => 'nullable|string|min:5|max:100',
            'phone' => 'nullable|min:5|max:20',
            'email' => 'nullable|email|unique:users',
            'password' => 'nullable|min:6|max:30',
            'agreement' => 'required'
        ];
    }
}
