<?php

namespace App\Services\User;

use App\Services\BaseServiceInterface;
use DB;
use App\Support\Enum\UserStatus;
use App\Models\User;
use App\Notifications\SendUserInvitationMail;
use App\Services\Mail\InviteUserMailFormat;
use Exception;

class SMSService implements BaseServiceInterface
{
    protected $message;
    protected $phone;
   
    public function __construct($message, $phone)
    {
        $this->message = $message;
        $this->phone = $phone;
    }

    public function run()
    {
        return $this->processInvite();
    }

    private function processInvite()
    {
      
        $curl = curl_init();
        $data = array("api_key" => "TLfjOpq1j8OaiQG44gtmWUEg5y0z4BI50yXEiKQwj8pOY3mZ4eUGjEhaasKXvg", "to" => $this->phone,  "from" => "HOO",
        "sms" => $this->message,  "type" => "plain",  "channel" => "generic" );
        
        $post_data = json_encode($data);
        
        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.ng.termii.com/api/sms/send",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => $post_data,
        CURLOPT_HTTPHEADER => array(
        "Content-Type: application/json"
        ),
        ));
        
        $response = json_decode(curl_exec($curl));
        curl_close($curl);

         if($response->message==='Successfully Sent'){
            return $response;
        }else{
           throw new Exception($response->message);
        }
       
       



     
    }



}