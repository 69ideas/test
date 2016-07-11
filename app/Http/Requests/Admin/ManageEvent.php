<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\Request;

class ManageEvent extends Request
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
            'short_description' => 'required|max:25',
            'start_date' => 'required',
            'deadline' => 'required',
        ];
    }
}
