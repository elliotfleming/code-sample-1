<?php

class AccountController extends BaseController
{
    /**
     * @var object The user model
     */
    protected $user;

    /**
     * @var object The profile model
     */
    protected $profile;

    /**
     * @var object The project model
     */
    protected $projects;

    /**
     * @var object The slice model
     */
    protected $slices;

    public function __construct(User $user)
    {
        parent::__construct();

        $this->beforeFilter('auth');
        $this->beforeFilter('authority.read:Account');

        $this->user = $user;

        $this->profile  = $this->user->profile;
        //$this->projects = $this->user->project()->get();
        //$this->slices   = $this->user->slice()->get();
    }

    public function getIndex()
    {
        $id = Auth::user()->id;
        $user = $this->user->findOrFail($id);

        return View::make('account.index', compact('user'));
    }

    public function getPrivacy()
    {
        return 'getPrivacy()';
    }

    public function postPrivacy()
    {
        return 'postPrivacy()';
    }

    public function getProfile()
    {
        return 'getProfile';
    }

    public function postProfile()
    {
        return 'postProfile()';
    }

    public function getSettings()
    {
        return 'getSettings()';
    }

    public function postSettings()
    {
        return 'postSettings()';
    }
}
