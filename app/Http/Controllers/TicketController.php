<?php

namespace App\Http\Controllers;

use App\Http\Requests\Ticket\CreateRequest;
use App\Services\Ticket\CreateService;
use App\Services\Ticket\ListService;
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

}
