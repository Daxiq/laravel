<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Session;
use Validator;

class SessionController extends Controller
{
    /**
    * GEt = /sessions
    *
    * @return \Illuninate\Http\Response
    **/
    public function index($id){
        $sessions = Session::where('event_id', $id)->get();

        return response()->json($sessions, 200);
    }

    /**
    * GEt = /session/$id
    *
    * @param int $id
    * @return \Illuninate\Http\Response
    **/
    public function show($id){
    	$session = Session::find($id);

    	return response()->json($session, 200);
    }

    /**
    * POST = /session
    *
    * @param \Illuninate\Http\Request $request
    * @return \Illuninate\Http\Response
    **/
    public function store(Request $request){
    	$input = $request->only([
    		'event_id', 'title', 'room', 'speaker'
    	]);

    	$val = Validator::make($input, [
    		'event_id' => 'required|exists:events,id',
    		'title' => 'required',
    		'room' => 'required',
    		'speaker' => 'required'
    	]);

    	if ($val->fails()) {
    		return response()->json([
    			'errors' => $val->errors()
    		], 422);
    	}

    	$session = Session::create($input);

    	return response()->json($session, 200);
    }

    /**
    * PUT = /session/{id}
    *
    * @param \Illuninate\Http\Request $request
    * @param $int $id
    * @return \Illuninate\Http\Response
    **/
    public function update(Request $request, $id){
    	$input = $request->only([
    		'event_id', 'title', 'room', 'speaker'
    	]);

    	$val = Validator::make($input, [
    		'event_id' => 'nullable',
    		'title' => 'nullable',
    		'room' => 'nullable',
    		'speaker' => 'nullable'
    	]);

    	if ($val->fails()) {
    		return response()->json([
    			'errors' => $val->errors()
    		], 422);
    	}

    	$session = Session::find($id);
    	$session->update($input);

    	return response()->json($session, 200);
    }

    /**
    * Delete = /session/$id
    *
    * @param $int $id
    * @return \Illuninate\Http\Response
    **/
    public function destroy($id){
    	Session::find($id)->delete();

    	return response()->json([
    		'message' => 'Deleted'
    	], 200);
    }

}
