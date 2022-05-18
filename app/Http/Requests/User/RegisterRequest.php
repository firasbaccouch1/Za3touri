<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class RegisterRequest extends FormRequest
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
            'first_name' => 'required|max:50|string',
            'last_name' => 'required|max:50|string',
            'email' => 'required|max:200|email|unique:users,email',
            'password' => 'required|max:150|string|confirmed|min:6',
        ];
    }
    public function failedValidation(Validator $validator)
    {
        $errors = $validator->errors(); 
        $response = response()->json([
            'message' => 'Invalid data send',
            'errors' => $errors->messages(),
        ],422);
        throw new HttpResponseException($response);
    }
    public function messages()
    {
        return [
            'required' => __('validation.required'),
            'max' => __('validation.max'),
            'string'=> __('validation.string'),
            'email'=> __('validation.email'),
            'unique'=> __('validation.unique'),
            'confirmed'=> __('validation.confirmed'),
            'min'=> __('validation.min'),

        ];
    }
}
