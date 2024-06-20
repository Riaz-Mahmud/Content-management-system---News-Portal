<?php

namespace App\Http\Requests\Backend\Poll\PollItem;

use Illuminate\Foundation\Http\FormRequest;

class PollItemRequest extends FormRequest
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
            'option' => 'required|max:100 |string',
            'position' => 'required|integer',
            'status' => 'required| in:Active,Inactive',
        ];
    }
}
