<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\Event\CreateRequest;
use App\Services\Event\CreateService;
use App\Http\Requests\Event\ListRequest;
use App\Models\Event;
use App\Services\Event\ListService;

class EventController extends Controller
{
 
    public function create(CreateRequest $request)
    {
        $validated = $request->validated();
        $user = \Auth::user();
        try {
            $new_client = (new CreateService($validated, $user))->run();
        } catch (\Exception $exception) {
            return response()->json(['status' => false, 'mesage' => 'Error processing request - '.$exception->getMessage(), 'data' => $exception], 500);
        }
        return response()->json(['status' => true, 'message' => 'New Event created', 'data' =>  $new_client], 201);
       
    }


    public function list(Request $request)
    {
        $user = \Auth::user();
        try {
            $list = (new ListService($request, $user))->run();
        } catch (\Exception $exception) {
            return response()->json(['status' => false, 'mesage' => 'Error processing request - '.$exception->getMessage(), 'data' => $exception], 500);
        }
        return response()->json(['status' => true, 'message' => 'Event List', 'data' =>  $list], 200);
       
    }


    public function get($id)
    {
        try {
            $event = Event::with(['tickets'])->findorfail($id);
        } catch (\Exception $exception) {
            return response()->json(['status' => false, 'mesage' => 'Error processing request - '.$exception->getMessage(), 'data' => $exception], 500);
        }
        return response()->json(['status' => true, 'message' => 'Event Details', 'data' => $event], 200);
       
    }

}
