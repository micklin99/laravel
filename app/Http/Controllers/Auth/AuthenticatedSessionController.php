<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



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
