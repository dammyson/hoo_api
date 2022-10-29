<?php

namespace App\Http\Resources;

use App\Models\Address;
use App\Models\Event;
use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'group_id' => $this->group_id,
            'location' => $this->location,
            'description' => $this->description,
            'category' => $this->category,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'type' => $this->type,
            'banner' => $this->banner,
            'tickets' => $this->tickets,
            'city' => $this->city,
            'is_liked' => $this->getAddress($this),
            'longitude' => $this->longitude,
            'latitude' => $this->latitude,
        ];
    }


    public function getAddress($id){
        $user = \Auth::user();
        $event = Event::findorfail($this->id);
        return $user->hasLiked($event);
    }
}
