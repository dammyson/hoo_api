<?php

namespace App\Services\Ticket;


use App\Services\BaseServiceInterface;
use App\Models\Event;
use App\Models\Ticket;

class CreateService implements BaseServiceInterface
{
    protected $data, $user;

    public function __construct($data)
    {
        $this->data = $data;
    }


    public function run()
    {
        return \DB::transaction(function () {
            foreach($this->data['ticket_list'] as $value){
                $new_event = Ticket::create([
                    'event_id' => $this->data['event_id'],
                    'title' => $value['title'],
                    'cost' => $value['cost'],
                    'quantity' => $value['quantity'],
                    'min_allow' => $value['min_allow'],
                    'max_llow' => $value['max_llow']
                ]);
            }
            return $this->data['event_id'];
        });
    }


  
}
