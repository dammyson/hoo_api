<?php

namespace App\Http\Requests\Ticket;

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
            'event_id' => 'required|string',
            'ticket_list' => 'required|array',
            'ticket_list.*.title' => 'required_with:ticket_list|string',
            'ticket_list.*.cost' => 'required_with:ticket_list|numeric',
            'ticket_list.*.quantity' => 'required_with:ticket_list|numeric',
            'ticket_list.*.min_allow' => 'required_with:ticket_list|numeric',
            'ticket_list.*.max_llow' => 'required_with:ticket_list|numeric'
        ];
    }
}