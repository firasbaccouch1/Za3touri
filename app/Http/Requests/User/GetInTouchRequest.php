<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class GetInTouchRequest extends FormRequest
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
            'name' => 'required|max:25|min:4|string',
            'email' => 'required|max:100|min:4|email',
            'subject' => 'required|max:25|min:4|string',
            'message' => 'required|max:400|min:10|string',
        ];
    }
}
