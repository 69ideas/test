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
        'name' => 'required|max:255',
        'name_2' => 'required_with:another_entry',
        'email_2' => 'email|required_with:another_entry',
        'amount' => 'required',
        'email' => 'email|required|confirmed',
    ];
    }
}
