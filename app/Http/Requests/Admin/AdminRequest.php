<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AdminRequest extends FormRequest
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
            'name'=>'required|string|max:50',
            'email'=>'required|email|max:100|unique:admins,email,'.$this->id.',id',
            'password' => 'sometimes|required|confirmed|string|max:50',
            'roles'=>'required|exists:roles,name|max:255|array',
            'admin'=>'exists:admins,id',
        ];
    }
}
