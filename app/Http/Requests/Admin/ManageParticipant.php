<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\Request;

class ManageParticipant extends Request
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
            'amount_deposited' => 'required',
            'name' => 'required_if:user_id,',
            'email' => 'required_if:user_id,',
            'deposit_date' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'amount_deposited.required' => 'The amount field is required',
            'name.required_if:user_id,' => 'The name field is required when participant is not set',
            'email.required_if:user_id,' => 'The email field is required when participant is not set',
            'deposit_date.required' => 'The deposit date field is required',
        ];
    }
}
