<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use DB;

use App\Models\State;
use App\Models\Country;
use App\Models\Address;
use App\Models\Contact;
use App\Models\Role;
use App\Models\Permission;
use App\Models\User;
use App\Models\Person;
use App\Models\Club;


use Illuminate\Support\Facades\Log;

// @see config/app.php
//
//    where 'Datatables' is an alias for 'Yajra\DataTables\Facades\DataTables'.
//
//  Alternatively, use the following...
//
//     use Yajra\DataTables\Facades\DataTables;
//
use App\DataTables\ClubDataTable;

class ClubController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( ClubDataTable $dataTable )
    {
	return $dataTable->render('clubs.index');
    }

    /**
     * Display the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
	return view('clubs.create', [
	    'countries' => Country::all()->sortBy('name'),
	    'states'    => State::all()->sortBy('name')
	]);
	
    }

    /**
     * Store a newly created 'Club' in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
	$rules = [
	    'name'      => ['required', 'string'],  
	    'website'   => ['required', 'string'],  
	    'subdomain' => ['required', 'string'],  
	    'firstName' => ['required', 'string'],  
	    'lastName'  => ['required', 'string'],  
	    'email'     => ['required', 'email'],
	    'password'  => ['required',
			    'string',
			    'min:8',              // must length
			    'confirmed',          // must have a 'password_confirmation' field
			    'regex:/[a-z]/',      // must contain at least one lowercase letter
			    'regex:/[A-Z]/',      // must contain at least one uppercase letter
			    'regex:/[0-9]/',      // must contain at least one digit
	    ],
	    'address1'   => ['required', 'string' ],  
	    'city'       => ['required', 'string' ],  
	    'state'      => ['required', 'string'],               // state[0] => id, state[1] = state name
	    'country'    => ['required', 'string'],  
	    'postalCode' => ['required', 'string' ],  
	    
	];
	
	$messages = [
	    'password.required' => 'The password must contain upper and lower case, a digit and be at least 8 characters long.',
	    'password.min'      => 'The password must be at least 8 characers long.',
	    'password.regex'    => 'The password must contain upper and lower case, a digit and be at least 8 characters long.',
	    'postalCode.regex'  => 'The zip code is required.',
	];
	
	$validator = Validator::make($request->all(), $rules, $messages);
	
	if ($validator->fails()) {
	    return redirect()->Back()->withInput()->withErrors($validator);
	}
	
	//Log::info("ClubController::store() request: " . print_r($request->all(), true));

	$club =	new Club($request->all());
	$club->save();

	// get the 'state' and country id
	$stateInfo           = explode( "|", $request->state, 2);
	$stateId             = $stateInfo[0];

	$countryInfo         = explode( "|", $request->country, 2);
	$countryId           = $countryInfo[0];

	// create a new Address
	$address = new Address($request->all());
	$address->state_id   = $stateId;
	$address->country_id = $countryId;
	$address->save();
	//Log::info("Address :" . $address);
	
	// create a new Contact
	$contact = new Contact($request->all());
	$contact->primaryEmail   = $request->email;
	$contact->address_id     = $address->id;
	$contact->save();	
	//Log::info("Contact :" . $contact);

	// create a new User
	$user            = new User($request->all());
	$user->firstname = $request->firstName;
	$user->lastname  = $request->lastName;
	$user->email     = $request->email;
	$user->password  = Hash::make( $request->password );
	$user->save();
	Log::info("Request Password :" . $request->password);	
	Log::info("User :" . $user);
	Log::info("Password :" . $user->password);

	// create a new person
	$person = new Person($request->all());
	$person->firstName    = $request->firstName;
	$person->lastName     = $request->lastName;
	$person->accountOwner = true;
	$person->user_id      = $user->id;
	$person->club_id      = $club->id;
	$person->contact_id   = $contact->id;
	$person->save();
	Log::info("Person :" . $person);

	// get the 'Club Administrator' role
	$result = DB::table('roles')->select('id')
		    ->where('title', 'Club System Administrator')->first();

	Log::info("PersonID/RoleId :" . $person->id . " " . $result->id);	

	// and assign this person the appropriate role...
	// 
        DB::table('person_role')->insert([
	    'person_id' => $person->id,
	    'role_id'   => $result->id
	]);

	return redirect()->route('clubs.index')
			 ->with('success', "Club created successfully");
	
    }

    /**
     * Display the specified resource.
     *
     * @param  id the club to display
     * @return \Illuminate\Http\Response
     */
    public function view( $id )
    {
	$club = Club::find($id);
	return view('clubs.view')->with('club', $club);
    }

    /**
     * Display the form for editing the specified resource.
     *
     * @param  $id    the club id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
	$club = Club::find($id);	

	return view('clubs.edit', [
	    'user'      => $club->admin()->user,
	    'address'   => $club->admin()->contact->address,
	    'countries' => Country::all()->sortBy('name'),
	    'states'    => State::all()->sortBy('name'),
	])->with('club', $club);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Club  $club
     * @return \Illuminate\Http\Response
     *
     * @see edit.blade.php 
     */
    public function update(Request $request, $id)
    {
	$data = $request->except('_method','_token','submit');

	$validator = Validator::make($request->all(), [
	    'name'      => 'required|string|min:2',
	    'website'   => 'required|string|min:2',
	    'subdomain' => 'required|string|min:2',
	]);

	if ($validator->fails()) {
	    return redirect()->Back()->withInput()->withErrors($validator);
	}
	
	$club = Club::find($id);

	if ($club->update($data))
	{
	    // get the Person, Contact, and Address info and
	    //    update those records
	    //
	    //    TODO: write logic to update Person, Contact, Address
	    //
	    //    TODO: evenutally move this logic to their own controller
	    //             methods, e.g. PersonController::update,
	    //                           ContactController::update, etc.
	    //

	    
	    Session::flash('message', 'Club Information updatede successfully.');
	    Session::flash('alert-class', 'alert-success');
	    return redirect()->route('clubs.index')
			     ->with('success','Club updated successfully');	    
	}
	else
	{
	    Session::flash('message', 'Data not updated!');
	    Session::flash('alert-class', 'alert-danger');
	}

	return Back()->withInput();
    }

    /**
     * Enable the specified club
     *
     * @param  \App\Models\Club  $club
     * @return \Illuminate\Http\Response
     */
    public function enable($id)
    {
	$club = Club::find($id);
	if (!$club->active)
	{
	    $club->active = true;
	    $club->save();
	}

	return redirect()->route('clubs.index');
    }


    /**
     * Disable the specified club
     *
     * @param  \App\Models\Club  $club
     * @return \Illuminate\Http\Response
     */
    public function disable($id)
    {
	$club = Club::find($id);
	if ($club->active)
	{
	    $club->active = false;
	    $club->save();	
	}
	
	return redirect()->route('clubs.index');	
    }

    /**
     * Delete the specified club
     *
     * @param  \App\Models\Club  $club
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request, $id)
    {
	$club = Club::find($id);
	if (!$club->active)
	{
	    /*
	       $res= Club::where('id',$id)->delete();
	       if ($res)
	       {
	       return redirect()->route('clubs.index')
	       ->with('success','Club deleted successfully.');
	       }
	     */

	    return redirect()->route('clubs.index')
			     ->with('error','Problem deleting club "' . $club->name . "'.");
	}

	return redirect()->route('clubs.index')
			 ->with('error','Club "' . $club->name . '" must be disabled before deleting.');
    }


}
