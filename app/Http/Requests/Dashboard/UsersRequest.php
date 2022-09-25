<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class UsersRequest extends FormRequest
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
            'name_surname' => 'required|string',
            'phone' => 'required|min:10',
            'email' => 'required|email|unique:users|regex:/(.+)@(.+)\.(.+)/i',
//            'password' => 'required|min:6',
//            'password_confirm' => 'required|same:password',
            'type' => 'required|integer',
            'roles' => 'required',
        ];
    }
}
