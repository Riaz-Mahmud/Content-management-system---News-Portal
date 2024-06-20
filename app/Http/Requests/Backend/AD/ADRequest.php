<?php

namespace App\Http\Requests\Backend\AD;

use Illuminate\Foundation\Http\FormRequest;

class ADRequest extends FormRequest
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
        if($this->route()->getName() == 'admin.ad.update'){
            return [
                'title' => 'required|max:180|string',
                'code' => 'required|string',
                'end_date' => 'required',
                'status' => 'required|in:Active,Inactive',
                'url' => 'required|url',
            ];
        }else{
            return [
                'title' => 'required|max:180|string',
                'code' => 'required|string',
                'end_date' => 'required',
                'image' => 'required',
                'status' => 'required|in:Active,Inactive',
                'url' => 'required|url',
            ];
        }
    }
}
