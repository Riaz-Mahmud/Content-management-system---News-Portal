<?php

namespace App\Http\Requests\Frontend\News;

use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
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
    public function rules(){
        if($this->hasFile('attach_file')){
            return [
                'comment' => 'nullable|string|max:190',
                'attach_file' => 'required|file|mimes:jpe,jpeg,png,jpg,gif,svg,mpeg,mp4',
            ];
        }else{
            return [
                'comment' => 'required|string|max:190',
                'attach_file' => 'nullable|file|mimes:jpe,jpeg,png,jpg,gif,svg,mpeg,mp4',
            ];
        }
    }
}
