<?php

namespace App\Services\Ticket;


use App\Models\Ticket;
use App\Services\BaseServiceInterface;

class ListService implements BaseServiceInterface
{


    public function __construct($event_id)
    {
        $this->event_id = $event_id;
    }


    public function run()
    {
        $tickets = [];
        $tickets =  Ticket::where('event_id',$this->event_id)->latest()->get();
        return $tickets;
    }
}
