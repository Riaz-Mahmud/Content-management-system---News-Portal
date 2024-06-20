<?php

namespace App\Http\Requests\Backend\News;

use Illuminate\Foundation\Http\FormRequest;

class NewsRequest extends FormRequest
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
        if($this->route()->getName() == 'admin.news.update'){
            return [
                'title' => 'required | max:180',
                'myeditorinstance' => 'required',
                'categories' => 'required',
                'image' => 'nullable|mimes:jpe,jpeg,png,jpg,gif,svg|max:1024',
                'image-video' => 'nullable|mimes:jpe,jpeg,png,jpg,gif,svg,mpeg,mp4|max:10240',
                'status' => 'required|in:Active,Inactive,Pending',
                'source_url' => 'nullable|url',
            ];
        }elseif($this->route()->getName() == 'admin.news.store'){
            return [
                'title' => 'required | max:180',
                'myeditorinstance' => 'required',
                'categories' => 'required',
                'image' => 'nullable|mimes:jpe,jpeg,png,jpg,gif,svg|max:1024',
                'image-video' => 'nullable|mimes:jpe,jpeg,png,jpg,gif,svg,mpeg,mp4|max:10240',
                'status' => 'required|in:Active,Inactive,Pending',
                'source_url' => 'nullable|url',
            ];
        }

    }
}
