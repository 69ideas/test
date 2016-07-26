<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class PayRequest extends Request
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
    { return [
        'part.*.name' => 'required|max:255',
        'part.*.amount' => 'required',
        'part.*.email' => 'email|required|confirmed',
    ];
    }

    public function messages()
    {
        return [
            'part.*.amount.required' => 'The amount field is required',
            'part.*.email.confirmed'  => 'The email confirmation does not match',
            'part.*.email.email'  => 'The email must be a valid email address',
            'part.*.email.required' => 'The email field is required',
            'part.*.name.required' => 'The name field is required',
            'part.*.name.max' => 'Maximum 255 symbols',
        ];
    }
}
