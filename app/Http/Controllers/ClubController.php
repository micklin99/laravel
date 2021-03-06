<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Club;

class ClubController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
	$pagerAmount = 10;

	$clubs = Club::latest()->paginate($pagerAmount);

	return view('clubs.index', compact('clubs'))
	       ->with('i', (request()->input('page', 1)-1) * $pagerAmount);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
	return view('clubs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
	    'name'      => 'required',
	    'website'   => 'required',
	    'subdomain' => 'required',
	]);

	Club::create($request->all());

	return redirect()->route('clubs.index')
			 ->with('success', "Club created successfully");
	
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Club  $club
     * @return \Illuminate\Http\Response
     */
    public function show(Club $club)
    {
	return view('clubs.show', compact('club'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Club  $club
     * @return \Illuminate\Http\Response
     */
    public function edit(Club $club)
    {
	return view('clubs.edit', compact('club'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Club  $club
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Club $club)
    {
	$request->validate([
	    'name'      => 'required',
	    'website'   => 'required',
	    'subdomain' => 'required',
	]);

	$club->update($request->all());

	return redirect()->route('clubs.index')
			 ->with('success','Club updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Club  $club
     * @return \Illuminate\Http\Response
     */
    public function destroy(Club $club)
    {
	$club->delete();

	return redirect()->route('clubs.index')
			 ->with('success','Club deleted successfully');
    }
}
