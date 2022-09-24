<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EventKinds;

class EventKindsController extends Controller
{



    public function get()
    {
      
        try {
            $resource = EventKinds::get();
            return response()->json(['status' => true, 'data' => $resource, 'message' => 'kinds  details'], 200);
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return response()->json(['status' => false,  'message' => 'Error processing request'], 500);
        }
    }
}
