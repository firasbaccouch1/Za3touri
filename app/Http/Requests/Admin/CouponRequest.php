<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CouponRequest extends FormRequest
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
            'code' => 'string|max:150|required|unique:coupons,code,'.$this->id.',id',
            'expiry_date'=> 'required|date|after:tomorrow',
            'discount'=>'required|numeric|max:100|min:1',
        ];
    }
}
