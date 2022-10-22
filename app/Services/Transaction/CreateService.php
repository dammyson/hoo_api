<?php

namespace App\Services\Transaction;


use App\Services\BaseServiceInterface;
use App\Models\Event;
use App\Models\Ticket;
use App\Models\Transaction;

class CreateService implements BaseServiceInterface
{
    protected  $user, $details, $type;

    public function __construct($user, $details, $type)
    {
       
        $this->user = $user;
        $this->details = $details;
        $this->type = $type;
    }

    public function run()
    {
        return \DB::transaction(function () {
                $new_event = Transaction::create([
                    'user_id' => $this->user->id,
                    'cost' => $this->details['data']['amount'],
                    'type' => $this->type,
                    'ref' => 'Paystack',
                    'status' => $this->details['data']['status'],
                ]);
            return $new_event;
        });
    }
}
