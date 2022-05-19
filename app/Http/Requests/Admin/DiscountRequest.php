<?php

namespace App\Http\Requests\Admin;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class DiscountRequest extends FormRequest
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
            'category'=> 'required_without:product|exists:categories,id|unique:discounts,category_id,'.$this->id.',id',
            'product'=> 'required_without:category|exists:products,id|unique:discounts,product_id,'.$this->id.',id',
            'expiry_date'=> 'required|date|after:tomorrow',
            'discount'=>'required|numeric|max:100|min:1',
        ];
    }
    public function messages()
    {
        return [
        'category.unique' => 'The category already has discount',
       'product.unique' => 'The product already has discount',
        ];

       
    }
}
