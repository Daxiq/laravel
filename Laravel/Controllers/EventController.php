<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\Http\Requests;
use App\Event;
// use App\Http\Resources\Event as EventResource;
use Validator;

class EventController extends Controller
{
    /**
    * GET = /events
    *
    * @return \Illunimate\Http\Response
    */

    public function index(){
    	$events = Event::orderBy('id', 'asc')->get();

    	return response()->json($events, 200);
    }

    /**
    * GET = /event/$id
    *
    * @param int $id
    * @return \Illunimate\Http\Response
    */

    public function show($id){
    	$event = Event::find($id);

    	return response()->json($event, 200);
    }

    /**
    * POST = /event
    *
    * @param \Illunimate\Http\Request $request
    * @return \Illunimate\Http\Response
    */
    public function store(Request $request){
    	$input = $request->only([
    		'title', 'description', 'date', 'time', 'duration_days', 'location', 'standard_price', 'capacity'
    	]);

    	$val = Validator::make($input, [
    		'title' => 'required',
    		'description' => 'required',
    		'date' => 'required',
    		'time' => 'required',
    		'duration_days' => 'required',
    		'location' => 'required',
    		'standard_price' => 'required',
    		'capacity' => 'required',
    	]);

    	if ($val->fails()){
    		return response()->json([
    			'errors' => $val->errors()
    		], 422);
    	}

    	$event = Event::create($input);

    	return response()->json($event, 200);
    }

    /**
    * PUT = /event/$id
    *
    * @param int $id
    * @param \Illunimate\Http\Request $request
    * @return \Illunimate\Http\Response
    */
    public function update(Request $request, $id){
    	$input = $request->only([
    		'title', 'description', 'date', 'time', 'duration_days', 'location', 'standard_price', 'capacity'
    	]);

    	$val = Validator::make($input, [
    		'title' => 'nullable',
    		'description' => 'nullable',
    		'date' => 'nullable',
    		'time' => 'nullable',
    		'duration_days' => 'nullable',
    		'location' => 'nullable',
    		'standard_price' => 'nullable',
    		'capacity' => 'nullable',
    	]);

    	if ($val->fails()){
    		return response()->json([
    			'errors' => $val->errors()
    		], 422);
    	}

    	$event = Event::find($id);

    	$event->update($input);

    	return response()->json($event, 200);
    }

    /**
    * DELETE = /event/$id
    *
    * @param int $id
    * @return \Illunimate\Http\Response
    */
    public function destroy($id){
    	Event::find($id)->delete();

    	return response()->json([
    		'message' => 'Deleted'
    	], 200);
    }
}
