<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
           'name_ar' => 'required|string|max:50|min:4',
           'name_en' => 'required|string|max:50|min:4',
           'icon'    => 'required|string|max:100|min:6'
        ];
    }
}
