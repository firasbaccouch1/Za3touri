<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SiteSettingsRequest extends FormRequest
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
            'name_en' => 'required|string|max:50',
            'name_ar'=>'required|string|max:50',
            'email'=>'required|email|max:100',
            'description' => 'required|string|max:255',
            'tags'=> 'nullable|string|max:200',
            'status' => 'numeric|max:1|min:0',
            'maintenance_message'=> "required|string|max:250",
            'logo_top' => 'mimes:'.Photo_Extension(),
            'logo_site' => 'mimes:'.Photo_Extension(),
            'maintenance_photo' => 'mimes:'.Photo_Extension(),
            'tax' => 'required|numeric|between:1,100',
            'shipping' => 'required|numeric|between:1,100',
        ];
    }
}
