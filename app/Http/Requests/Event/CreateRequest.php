<?php

namespace App\Http\Requests\Event;

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
    
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|string',
            'location' => 'required|string',
            'description' => 'required|string',
            'category' => 'required|string',
            'start_date' => 'required|string',
            'end_date' => 'required|date',
            'type' => 'required|string',
            'banner' => 'required|string',
            'tickets' => 'required|string',
            'city' => 'required|string',
            'longitude' => 'required|numeric',
            'latitude' => 'required|numeric',
        ];
    }
}