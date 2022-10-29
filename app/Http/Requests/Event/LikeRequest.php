<?php

namespace App\Http\Requests\Event;

use App\Http\Requests\Request;

class LikeRequest extends Request
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
            'event_id' => 'required|string',
            'action' => 'required|string',
        ];
    }
}