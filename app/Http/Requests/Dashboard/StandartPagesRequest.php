<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class StandartPagesRequest extends FormRequest
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
            'az_name' => 'required|string|max:255|min:1',
            'ru_name' => 'required|string|max:255|min:1',
            'en_name' => 'required|string|max:255|min:1',
            'az_description' => 'required|min:1',
            'en_description' => 'required|min:1',
            'ru_description' => 'required|min:1',
            'type' => 'required',
//            'bg_image' => 'required|mimes:jpg,jpeg,pjpeg,pjp,avif,jfif,bmp,ico,cur,png,gif,svg,webp,tif,tiff',

        ];
    }
}
