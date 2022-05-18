<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;



class RolesRequest extends FormRequest
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
           'name' => 'required|string|max:100|unique:roles,name,'.$this->id.'id',
           'guard_name' => 'required|in:admin,web|max:100',
           'permissions' => 'required|exists:permissions,id',
           
        ];
    }
}
