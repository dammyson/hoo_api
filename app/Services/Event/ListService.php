<?php

namespace App\Services\Event;

use App\Models\Event;
use App\Models\Groups;
use App\Services\BaseServiceInterface;
use App\Services\User\GetUserPref;

class ListService implements BaseServiceInterface
{


    public function __construct($data, $user)
    {
        $this->data = $data;
        $this->user = $user;
    }


    public function run()
    {
        $events = [];
       // $pref = (new GetUserPref($this->user))->run();
       $pref = json_decode($this->user->prefs->prefs);

        if ($this->data['category']) {
            $events =  Event::whereIn('category',$this->data['category'])->get();
        } else {
            $events =  Event::whereIn('category', $pref)->get();
        }
       
         return $events;
    }
}
