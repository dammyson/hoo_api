<?php

namespace App\Services\User;

use App\Models\Otp;
use App\Services\BaseServiceInterface;


class CreateOtpService implements BaseServiceInterface
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function run()
    {
        return \DB::transaction(function () {
                $new_event = Otp::create([
                    'phone_number' => $this->data['phone_number'],
                    'otp' =>$this->generateOtp(),
                    'is_verified' =>false,
                ]);

            return $new_event;
        });
    }



    private function generateOtp()
    {
        return "ASDF";
    }
  
}