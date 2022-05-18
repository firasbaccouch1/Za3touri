<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class AddressBookRequest extends FormRequest
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
            'first_name' => 'required|string|min:4|max:30',
            'last_name' => 'required|string|min:4|max:30',
            'phone' => 'numeric|required|min:4|max:999999999999999',
            'state' => 'required|min:6|max:255',
            'street_address' => 'required|min:6|max:255',
            'zip_code' => 'numeric|required|max:99999',
            'city' => 'required|min:3|max:255',
            'country_id' => 'exists:countries,id',
        ];
    }
}
