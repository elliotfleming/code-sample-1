<?php

use EveryEquity\Storage\User\UserRepositoryInterface as User;

class AdminController extends BaseController
{
    /**
     * @var object The user model
     */
    protected $user;

    public function __construct(User $user)
    {
        parent::__construct();

        $this->beforeFilter('auth');
        $this->beforeFilter('authority.read:Admin');

        $this->user = $user;
    }

    public function getIndex()
    {
        $users = $this->user->all();

        return View::make('admin.index', compact('users'));
    }
}
