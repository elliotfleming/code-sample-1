<?php

class SplashController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getIndex()
    {
        return View::make('splash.index')->with('signedup', false);
    }

    public function postIndex()
    {
        $email     = Input::get('email');
        $cofounder = Input::get('co-founder');
        $founder   = Input::get('founder');
        $investor  = Input::get('investor');

        $userInfo = [
            'email' => $email
        ];

        $validator = Validator::make($userInfo, [
            'email' => 'required|max:128|email'
        ]);

        if ($validator->fails())
        {
            return Redirect::to('/splash')
                ->with('signedup', false)
                ->withInput()
                ->withErrors($validator);
        }

        // Update previous entry or Insert a new entry
        $previous = Newsletter::where('email', $email)->first();
        $entry = $previous ?: new Newsletter;
        $updated = $previous ? true : false;

        $entry->email = $email;
        $entry->cofounder = $cofounder ? 1 : 0;
        $entry->founder = $founder ? 1 : 0;
        $entry->investor = $investor ? 1 : 0;
        $entry->save();

        $data = [
            'signedup'  => true,
            'updated'   => $updated,
            'email'     => $email,
            'cofounder' => $cofounder,
            'founder'   => $founder,
            'investor'  => $investor
        ];

        return View::make('splash.index', $data);
    }
}
