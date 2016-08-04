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
            'name' => 'required',
            'email' => 'required',
            'deposit_date' => 'required',
        ];
    }
}
