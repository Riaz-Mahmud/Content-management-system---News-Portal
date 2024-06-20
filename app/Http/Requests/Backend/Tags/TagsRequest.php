<?php

namespace App\Http\Requests\Backend\Tags;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Crypt;

class TagsRequest extends FormRequest
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
        if($this->route()->getName() == 'admin.tags.update'){
            return [
                'label' => ['required','string','max:20', Rule::unique('tags')->ignore(Crypt::decrypt($this->id))],
                'status' => 'required|in:Active,Inactive',
            ];
        }else{
            return [
                'label' => 'required|string|max:20|unique:tags,label',
                'status' => 'required|in:Active,Inactive',
            ];
        }
    }
}
