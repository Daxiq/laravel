<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Registration;
use App\Event;
use App\Http\Resources\Registration as RegistrationResource;
use Validator;

class RegistrationController extends Controller
{
	/**
	* GET = /registrations/$id
	*
	* @param int $id
	* @return \Illuminate\Http\Response
	*/
    public function index($id){
    	$registrations = DB::table('events')
    		->select('events.*', 'registrations.*')
    		->join('registrations', 'registrations.event_id', '=', 'events.id')
    		->where('registrations.user_id', '=', $id)
    		->get();

    	return response()->json($registrations, 200);
    }

    /**
    * GeT = /registration/$id
    *
    * @param int $id
    * @return \Illuminate\Http\Response
    */
    public function show($id){
    	$registrations = DB::table('users')
    		->select('users.*', 'registrations.*')
    		->join('registrations', 'registrations.user_id', '=', 'users.id')
    		->where('registrations.event_id', '=', $id)
    		->get();

    	return response()->json($registrations, 200);
    }

    /**
    * POST = /registration
    *
    * @param \Illuninate\Http\Request $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request){
    	$registration = $request->isMethod('put') ? Registration::findOrfail($request->registration_id) : new Registration;

    	$registration->user_id = $request->input('user_id');
    	$registration->event_id = $request->input('event_id');
    	$registration->registration_date  = date('Y-m-j');
    	$registration->registration_type = $request->input('registration_type');
    	$registration->calculate_price = $request->input('calculate_price');

    	if ($registration->save()) {
    		return new RegistrationResource($registration);
    	}

    }

    public function update(Request $request, $id){
    	$input = $request->only([
    		'event_rating'
    	]);

    	$val = Validator::make($input,[
    		'event_rating' => 'nullable'
    	]);

    	if ($val->fails()) {
    		return response()->json([
    			'errors' => $val->errors()
    		], 422);
    	}

    	$registration = Registration::find($id);
    	$registration->update($input);
    	return response()->json($registration, 200);
    }

    public function destroy($id){
    	Registration::find($id)->delete();

    	return response()->json([
    		'message' => 'Deleted'
    	], 200);
    }
}
