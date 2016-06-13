<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class AdminArticleRequest extends Request
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
            'title' => 'required',
            'text' => 'required',
            'youtube' => 'required_if:resource_type,youtube|url',
            'region_id' => 'exists:regions,id',
            'resource_type' => 'required|in:youtube,image',
            'image' => 'image'
        ];
    }
}
