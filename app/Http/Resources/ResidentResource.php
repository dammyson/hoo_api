<?php

namespace App\Http\Resources;

use App\Models\Address;
use Illuminate\Http\Resources\Json\JsonResource;

class ResidentResource extends JsonResource
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
            'user_id' => $this->user_id,
            'company_id' => $this->company_id,
            'group_id' => $this->group_id,
            'first_name' => $this->first_name,
            'middle_name' => $this->middle_name,
            'last_name' => $this->last_name,
            'nick_name' => $this->nick_name,
            'dob' => $this->dob,
            'avatar' => $this->avatar,
            'mobile_phone' => $this->mobile_phone,
            'home_phone' => $this->home_phone,
            'email' => $this->email,
            'mailing_address' => $this->getAddress($this->mailing_address),
            'physical_address' => $this->getAddress($this->physical_address),
            'previous_address' =>  $this->getAddress($this->previous_address),
            'flags' => json_decode( $this->flags),
            'income' => $this->income,
            'military_information' => $this->military_information,
            'mail_preference' => $this->mail_preference,
            'admission_info' => $this->admission_info
        ];
    }


    public function getAddress($id){
        return Address::find($id);

    }
}
