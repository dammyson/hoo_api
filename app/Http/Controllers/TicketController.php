<?php

namespace App\Http\Controllers;

use App\Http\Requests\Ticket\BuyCreateRequest;
use App\Http\Requests\Ticket\CreateRequest;
use App\Services\Ticket\BuyTicketService;
use App\Services\Ticket\CreateService;
use App\Services\Ticket\ListService;
use App\Services\Transaction\CreateService as TransactionCreateService;
use App\Services\Transaction\VerificationService;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    //
    public function create(CreateRequest $request)
    {
        $validated = $request->validated();

        try {
            $new_tickets = (new CreateService($validated))->run();
            $new_tickets = (new ListService($validated['event_id']))->run();
        } catch (\Exception $exception) {
            return response()->json(['status' => false, 'mesage' => 'Error processing request - '.$exception->getMessage(), 'data' => $exception], 500);
        }
        return response()->json(['status' => true, 'message' => 'New Tickets created', 'data' =>  $new_tickets], 201);
       
    }



      //
      public function list($event_id)
      {
          try {
              $new_tickets = (new ListService($event_id))->run();
          } catch (\Exception $exception) {
              return response()->json(['status' => false, 'mesage' => 'Error processing request - '.$exception->getMessage(), 'data' => $exception], 500);
          }
          return response()->json(['status' => true, 'message' => 'Tickets List', 'data' =>  $new_tickets], 200);
         
      }

      public function buy(BuyCreateRequest $request)
      {
        $validated = $request->validated();
        $user = \Auth::user();
      //  dd($validated);
        

        try {
            $transaction_details = (new VerificationService($validated['ref']))->run();
            if($transaction_details['status']){
                $new_transaction= (new TransactionCreateService( $user, $transaction_details,"Ticket"))->run();
                $new_tickets = (new BuyTicketService($validated, $user, $new_transaction->id))->run();
            }else{
                return response()->json(['status' => true, 'message' => 'Payment Verification failed Tickets purchased'], 500);
            }
           // $new_tickets = (new ListService($validated['event_id']))->run();
        } catch (\Exception $exception) {
            return response()->json(['status' => false, 'mesage' => 'Error processing request - '.$exception->getMessage(), 'data' => $exception], 500);
        }
        return response()->json(['status' => true, 'message' => 'Tickets List', 'data' =>  $new_tickets], 200);
      }



}
