<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\Request;

class CreateRequest extends Request
{
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
            'email' => 'required|email|unique:users',
            'username' => 'required|string',
            'phone_number' => 'required|string',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'gender' => 'required|string',
            'dob' => 'required|date',
            'baby' => 'required|boolean',
            'relationship_status' => 'required|string',
            'state' => 'required|string',
            'avatar' => 'sometimes|required|url',
            'password' => 'required|min:6',
            'confirm_password' => 'required|same:password',
            'prefs'=> 'required|array'
        ];
    }
}