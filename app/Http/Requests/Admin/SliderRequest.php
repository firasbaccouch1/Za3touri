<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SliderRequest extends FormRequest
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
            'title_en' => 'required|string|max:50|min:5',
            'title_ar'=>'required|string|max:50|min:5',
            'short_description_en' =>'required|string|max:255|min:5',
            'short_description_ar' => 'required|string|max:255|min:5',
            'photo'=> 'sometimes|required|mimes:'.Photo_Extension(),
            'category'=>'required|exists:categories,id',
            'old_photo' => 'exists:sliders,photo',
        ];
    }
}
