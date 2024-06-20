<?php

namespace App\Http\Requests\Backend\Slide;

use Illuminate\Foundation\Http\FormRequest;

class SlideItemRequest extends FormRequest
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

        // if it comes from route('admin.slide.item.update') then image is not required
        if($this->route()->getName() == 'admin.slide.item.update'){
            if($this->type == 'image'){
                return [
                    'title' => 'required|max:180',
                    'status' => 'required',
                    'type' => 'required',
                    'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                ];
            }else{
                return [
                    'status' => 'required',
                    'type' => 'required',
                    'news' => 'required',
                ];
            }
        }else{
            if($this->type){
                if($this->type == 'image'){
                    return [
                        'title' => 'required | max:180',
                        'status' => 'required',
                        'type' => 'required',
                        'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                    ];
                }else{
                    return [
                        'status' => 'required',
                        'type' => 'required',
                        'news' => 'required',
                    ];
                }
            }else{
                return [
                    'type' => 'required',
                ];
            }


        }
    }
}
