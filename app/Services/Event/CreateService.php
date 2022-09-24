<?php

namespace App\Services\Event;


use App\Services\BaseServiceInterface;
use App\Models\Event;

class CreateService implements BaseServiceInterface
{
    protected $data, $user;

    public function __construct($data, $user)
    {
        $this->data = $data;
        $this->user = $user;
    }


    public function run()
    {
        return \DB::transaction(function () {

            $new_event = Event::create([
                'user_id' => $this->user->id,
                'title' => $this->data['title'],
                'location' => $this->data['location'],
                'description' => $this->data['description'],
                'category' => $this->data['category'],
                'start_date' => $this->data['start_date'],
                'end_date' => $this->data['end_date'],
                'type' => $this->data['type'],
                'banner' => $this->data['banner'],
                'tickets' => $this->data['tickets'],
                'city' => $this->data['city'],
                'longitude' => $this->data['longitude'],
                'latitude' => $this->data['latitude'],
        
            ]);


            return $new_event;
        });
    }


  
}
