<?php

class AuthController extends BaseController
{
    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @link   /auth (GET)
     * @return void Redirect
     */
    public function getIndex()
    {
        return Redirect::route('auth.login');
    }

    /**
     * @route  auth.signup
     * @link   /signup, /auth/signup (GET)
     * @return mixed View or Redirect
     */
    public function getSignup()
    {
        // Only show the signup page if the user is a guest
        if (Auth::guest()) return View::make('auth.signup');

        return Redirect::route('home');
    }

    /**
     * @route  auth.signup.post
     * @link   /signup, /auth/signup (POST)
     * @return void Redirect
     */
    public function postSignup()
    {
        // Get the user input
        $email                 = Input::get('email');
        $password              = Input::get('password');
        $password_confirmation = Input::get('password_confirmation');

        // Create an array of user-credentials
        $credentials = [
            'email'                 => $email,
            'password'              => $password,
            'password_confirmation' => $password_confirmation
        ];

        // Validate the user's credentials
        $validator = Validator::make($credentials, [
            'email'                 => 'required|max:128|email|unique:users',
            'password'              => 'required|confirmed',
            'password_confirmation' => 'required',
        ]);

        // Show the form again with Validation errors
        if ($validator->fails())
        {
            return Redirect::route('auth.signup')
                ->withInput(Input::only('email'))
                ->withErrors($validator);
        }

        // If validation passes, create the new User
        $user = new User;
        $user->email = $email;
        $user->password = Hash::make($password); // (bcrypt)
        $user->activated = 1; // Hard coded for now
        $success = $user->save();

        // The User was successfully created
        if ($success) {

            // Log the new User in
            Auth::login($user);

            // Redirect to the home page with a success message
            Notification::success('You are now signed up and logged in.');
            return Redirect::route('home');
        }

        // The User was not successfully created -- Redirect with errors
        return Redirect::route('auth.signup')
            ->withInput(Input::only('email'))
            ->withErrors(['system_error' => 'System Error']);
    }

    /**
     * @route  auth.login
     * @link   /login, /auth/login (GET)
     * @return mixed View or Description
     */
    public function getLogin()
    {
        // Only show the login page if the user is a guest
        if (Auth::guest()) return View::make('auth.login');

        return Redirect::route('home');
    }

    /**
     * @route  auth.login.post
     * @link   /login, /auth/login (POST)
     * @return void Redirect
     */
    public function postLogin()
    {
        // Get the user input
        $email    = Input::get('email');
        $password = Input::get('password');

        // Create an array of user-credentials
        $credentials = [
            'email'    => $email,
            'password' => $password
        ];

        // Show the form again with Validation errors
        $validator = Validator::make($credentials, [
            'email'    => 'required|max:128|email',
            'password' => 'required'
        ]);

        // Show the form again with Validation errors
        if ($validator->fails())
        {
            // Send a response for AJAX requests
            if (Request::ajax())
            {
                $notification = ['notification' => 'Your credentials are invalid'];
                return Response::json($notification);
            }

            return Redirect::route('auth.login')
                ->withInput(Input::only('email'))
                ->withErrors($validator);
        }

        // Attempt to login the user (their account must be activated)
        $credentials['activated'] = 1;
        if (Auth::attempt($credentials))
        {
            // Send a response for AJAX requests
            if (Request::ajax())
            {
                $notification = ['notification' => 'You are now logged in.'];
                return Response::json($notification);
            }

            // Redirect to the intended destination with a success message
            Notification::success('You are now logged in.');
            return Redirect::intended('/');
        }

        // The User could not be logged in -- Redirect with errors
        return Redirect::route('auth.login')
            ->withInput(Input::only('email'))
            ->withErrors(['login' => true]);
    }

    /**
     * @route  auth.logout
     * @link   /logout, /auth/logout (GET)
     * @return void Redirect
     */
    public function getLogout()
    {
        // Log the User out -- Redirect with a success message
        Auth::logout();

        // Send a response for AJAX requests
        if (Request::ajax())
        {
            $notification = ['notification' => 'You are now logged out.'];
            return Response::json($notification);
        }

        Notification::success('You are now logged out.');
        return Redirect::route('auth.login');
    }
}
