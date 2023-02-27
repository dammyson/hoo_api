<?php

namespace App\Services\User;

use App\Models\EventKinds;
use App\Models\User;
use App\Services\BaseServiceInterface;

class GetUserPref implements BaseServiceInterface
{
    protected $id;

    public function __construct($user)
    {
        $this->user = $user;
    }

    public function run()
    {
        $user_pref = [];
        dd($this->user->prefs);
        dd($this->user->prefs->pluck('id'));

       
        $events =  EventKinds::whereIn('id', json_decode($pref->prefs->prefs))->get();

        foreach($events as $value){
            array_push($user_pref,$value->name);
        }
        return $user_pref ;
    }
}
