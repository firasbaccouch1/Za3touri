<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class OrdersRequest extends FormRequest
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
            'first_name' => 'string|max:50|min:4|required',
            'last_name' => 'string|max:50|min:4|required',
            'email' => 'email|max:100|min:10|required',
            'city' => 'required|min:4|max:50|string',
            'phone' => 'numeric|max:9999999999|min:1000000|required',
            'country' => 'exists:countries,id|required',
            'street_address' => 'string|max:100|min:4|required',
            'state' => 'string|max:100|min:4|required',
            'zip_code' => 'string|max:10|min:4|required',
            'note' => 'max:500|min:10|string'
        ];
    }
}
