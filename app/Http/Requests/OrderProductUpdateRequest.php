<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderProductUpdateRequest extends FormRequest
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
            'product'       =>  'required|max:191',
            'client_id'     =>  'required|not_in:0',
            'total'         =>  'required|regex:/^\d+(\.\d{1,2})?$/',
            'date'          =>  'required|date|regex:/\d{1,2}\/\d{1,2}\/\d{4}/',
        ];
    }
}
