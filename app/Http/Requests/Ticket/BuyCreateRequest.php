<?php

namespace App\Http\Requests\Ticket;

use App\Http\Requests\Request;

class BuyCreateRequest extends Request
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
            'ref' => 'required|string',
            'ticket_list' => 'required|array',
            'ticket_list.*.ticket_id' => 'required_with:ticket_list|string',
            'ticket_list.*.quantity' => 'required_with:ticket_list|numeric',
            'ticket_list.*.first_name' => 'required_with:ticket_list|string',
            'ticket_list.*.last_name' => 'required_with:ticket_list|string',
            'ticket_list.*.email' => 'required_with:ticket_list|string',
            'ticket_list.*.phone_number' => 'required_with:ticket_list|string'
        ];
    }
}