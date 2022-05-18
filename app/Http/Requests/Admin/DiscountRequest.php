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
            'category'=> 'required_without:product|exists:categories,id',
            'product'=> 'required_without:category|exists:products,id',
            'expiry_date'=> 'required|date|after:tomorrow',
            'discount'=>'required|numeric|max:100|min:1',
        ];
    }
}
