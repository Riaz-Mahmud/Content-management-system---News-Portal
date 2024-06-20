<?php

namespace App\Http\Requests\Backend\Page;

use Illuminate\Foundation\Http\FormRequest;

class PageRequest extends FormRequest
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
        if($this->route()->getName() == 'admin.page.update'){
            return [
                'title' => 'required | max:180',
                'myeditorinstance' => 'required',
                'status' => 'required|in:Active,Inactive',
            ];
        }else{
            return [
                'title' => 'required | max:180',
                'myeditorinstance' => 'required',
                'status' => 'required|in:Active,Inactive',
            ];
        }
    }
}
