<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InvoiceRequest extends FormRequest
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
            'title' => 'required|string|min:5|max:250',
            'payment_method' => 'required|string|min:2|max:100',
            'invoice_issue_date' => 'required',
            'invoice_due_date' => 'required',
            'customer_id' => 'required',
        //    'item_description' => 'required|string|min:10|max:200',
        //    'item_qty' => 'required|min:1|max:50',
        //    'item_rate' => 'required|min:1',
        //    'item_total' => 'required',
            'sub_total' => 'required',
            'tax' => 'required|numeric',
            'discount' => 'required|numeric',
            'grand_total' => 'required',
            'notes' => 'nullable|string|max:500',
        ];
    }
}
