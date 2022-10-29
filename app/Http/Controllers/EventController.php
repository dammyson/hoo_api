<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\Event\CreateRequest;
use App\Http\Requests\Event\LikeRequest;
use App\Services\Event\CreateService;
use App\Http\Requests\Event\ListRequest;
use App\Http\Resources\EventResource;
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
            $resource = new EventResource(Event::with(['tickets'])->findorfail($id));
        } catch (\Exception $exception) {
            return response()->json(['status' => false, 'mesage' => 'Error processing request - '.$exception->getMessage(), 'data' => $exception], 500);
        }
        return response()->json(['status' => true, 'message' => 'Event Details', 'data' => $resource], 200);
       
    }

    public function search ($search){
      
        try {
            $posts = Event::query()
            ->where('title', 'LIKE', "%{$search}%")
            ->orWhere('location', 'LIKE', "%{$search}%")
            ->get();
        } catch (\Exception $exception) {
            return response()->json(['status' => false, 'mesage' => 'Error processing request - '.$exception->getMessage(), 'data' => $exception], 500);
        }
        return response()->json(['status' => true, 'message' => 'Event List', 'data' =>   $posts], 200);
    }

    public function like(LikeRequest $request)
    {

        $validated = $request->validated();
        $msg = "No action taken";

      

     try {
        $user = \Auth::user();
        $event = Event::with(['tickets'])->findorfail($validated['event_id']);
        if($validated['action'] == "like"){
            if(!$user->hasLiked($event)){
                $user->like($event);
                $msg = "Event Liked";
            }
        }else if($validated['action'] == "unlike"){
            if($user->hasLiked($event)){
                $user->unlike($event);
                $msg = "Event Unliked";
            }
        }
          
        } catch (\Exception $exception) {
            return response()->json(['status' => false, 'mesage' => 'Error processing request - '.$exception->getMessage(), 'data' => $exception], 500);
        }
        return response()->json(['status' => true, 'message' =>  $msg , 'data' =>  $event], 200);
       
    }
    

}
