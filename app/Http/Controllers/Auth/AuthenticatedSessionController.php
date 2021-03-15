<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;



class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
	// attempt to authenticate this LoginRequest.  If we fail, then
	//    a 'ValidationException' is thrown...
        $request->authenticate();

	// regenerate a new session id to prevent session fixation attacks...
        $request->session()->regenerate();

	// We should be successfully authenticated, but let's make sure here...
	//
	if (Auth::check())
	{
	    // set session variables...
	    
	    $request->session()->put('id',        Auth::user()->id);
	    $request->session()->put('firstName', Auth::user()->firstname);
	    $request->session()->put('lastName',  Auth::user()->lastname);

	    // get the person who owns this account

	    $person = DB::table('people')->select('id')
			->where('user_id', Auth::user()->id)->first();

	    //
	    //  ** Get all of the roles for this person **
	    //
	    //   SELECT r.title FROM roles r INNER JOIN person_role pr ON pr.role_id = r.id WHERE pr.person_id = x;
	    //

	    $roles = DB::table('roles as r')->select('r.title')
		       ->join('person_role as pr', 'pr.role_id', '=', 'r.id')
		       ->where('pr.person_id', '=', $person->id)->get();

	    $user_roles = [];
	    
	    foreach ($roles as $role)
	    {
		$user_roles[] = $role->title;
	    }

	    $request->session()->put('roles',  $user_roles);
	}			  

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
