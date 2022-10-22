<?php
namespace App\Services\Ticket;

use App\Services\BaseServiceInterface;
use App\Models\MyTicket;

class BuyTicketService implements BaseServiceInterface
{
    protected $data, $user, $transaction_id;

    public function __construct($data, $user, $transaction_id)
    {
        $this->data = $data;
        $this->user = $user;
        $this->transaction_id = $transaction_id;
    }


    public function run()
    {
       
        return \DB::transaction(function () {
            $tickets = array();
            foreach($this->data['ticket_list'] as $value){
                $new_event = MyTicket::create([
                    'user_id' => $this->user->id,
                    'event_id' => $this->data['event_id'],
                    'ticket_id' => $value['ticket_id'],
                    'transaction_id' => $this->transaction_id,
                    'quantity' => $value['quantity'],
                    'first_name' => $value['first_name'],
                    'last_name' => $value['last_name'],
                    'email' => $value['email'],
                    'phone_number' => $value['phone_number']

                ]);
                array_push($tickets,$new_event);
            }
            return $tickets;
        });
    }
}
