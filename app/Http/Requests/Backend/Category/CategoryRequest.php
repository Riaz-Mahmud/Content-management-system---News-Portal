<?php

namespace App\Http\Requests\Backend\Category;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Crypt;

class CategoryRequest extends FormRequest
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
        if($this->route()->getName() == 'admin.category.update'){
            return [
                'title' => ['required','string','max:180', Rule::unique('categories')->ignore(Crypt::decrypt($this->id))],
                'status' => 'required|in:Active,Inactive',
            ];
        }else{
            return [
                'title' => 'required|max:180|string|unique:categories,title',
                'status' => 'required|in:Active,Inactive',
            ];
        }
    }
}
