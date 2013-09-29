<?php

///////////////////////////////////////////////////////////////////////////////
// Authority Filters /////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////

Route::filter('authority.create', function($route, $request, $resource)
{
	if (Authority::cannot('create', $resource))
    {
    	Notification::error('You do not have create permissions for <b>'.$resource.'<b>');
        return Redirect::route('home');
    }
});

Route::filter('authority.read', function($route, $request, $resource)
{
	if (Authority::cannot('read', $resource))
    {
    	Notification::error('You do not have read permissions for <b>'.$resource.'</b>');
    	Notification::warning('This is your final warning');
    	Notification::info('Try staying where you belong');
    	Notification::success('Stay positive');
        return Redirect::route('home');
    }
});

Route::filter('authority.update', function($route, $request, $resource)
{
	if (Authority::cannot('update', $resource))
    {
    	Notification::error('You do not have update permissions for <b>'.$resource.'<b>');
        return Redirect::route('home');
    }
});

Route::filter('authority.delete', function($route, $request, $resource)
{
	if (Authority::cannot('delete', $resource))
    {
    	Notification::error('You do not have delete permissions for <b>'.$resource.'<b>');
        return Redirect::route('home');
    }
});


///////////////////////////////////////////////////////////////////////////////
// Native Laravel Filters ////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/

App::before(function($request)
{
	/* Need a way to test if using this method
    if (Auth::check())
	{
		View::share('user', Auth::user());
	}*/

    /**
     * $ee Singleton object
     *
     * This is just an overly complicated version of the above
     * meant to demonstrate Laravel singleton usage
     *//*
    App::singleton('ee', function()
    {
        $app = new stdClass;
        $app->title = "Every Equity";
        if (Auth::check()) {
            $app->user = Auth::User();
            $app->loggedIn = true;
        } else {
        	$app->user = false;
            $app->loggedIn = false;
        }
        return $app;
    });
    $app = App::make('ee');
    View::share('ee', $app);
    */
});

//View::creator('home.index', 'HomeCreator');

App::after(function($request, $response)
{
	//
});

/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application. The "basic" filter easily
| integrates HTTP Basic authentication for quick, simple checking.
|
*/

Route::filter('auth', function()
{
	if (Auth::guest()) return Redirect::guest('login');
});

Route::filter('guest', function()
{
    if (Auth::check()) return Redirect::guest('home');
});

Route::filter('auth.basic', function()
{
	return Auth::basic();
});

/*
|--------------------------------------------------------------------------
| Guest Filter
|--------------------------------------------------------------------------
|
| The "guest" filter is the counterpart of the authentication filters as
| it simply checks that the current user is not logged in. A redirect
| response will be issued if they are, which you may freely change.
|
*/

Route::filter('guest', function()
{
	if (Auth::check()) return Redirect::to('/');
});

/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/

/**
 * This filter has been modified to accomodate AJAX requests as well
 *
 * @added => && Session::token() != Request::header('x-csrf-token')
 */
Route::filter('csrf', function()
{
	if (Session::token() != Input::get('_token') && Session::token() != Request::header('x-csrf-token'))
	{
		throw new Illuminate\Session\TokenMismatchException;
	}
});
