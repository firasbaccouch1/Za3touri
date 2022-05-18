<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'name_en'=> 'required|string|max:100',
            'name_ar'=>'required|string|max:100',
            'discription_en'=>'string|max:1500',
            'discription_ar'=> 'string|max:1500',
            'price'=>'required|string|between:1,99999999',
            'thumbnail'=>'sometimes|required|mimes:'.Photo_Extension(),
            'images.*'=> 'mimes:'.Photo_Extension(),
            'qantite'=> 'required|numeric|between:1,99999999',
            'category'=> 'exists:categories,id|required',
            'old_img' =>'exists:products,thumbnail',
          
        ];
    }
}
