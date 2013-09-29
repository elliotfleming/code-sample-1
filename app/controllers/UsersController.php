<?php

class UsersController extends BaseController
{
	/**
	 * User Repository
	 *
	 * @var User
	 */
	protected $user;

	public function __construct(User $user)
	{
		$this->beforeFilter('auth');
        $this->beforeFilter('authority.read:Users');

		$this->user = $user;
	}

	/**
	 * Public listing of the users.
	 *
	 * @return Response
	 */
	public function index()
	{
		$users = $this->user->with('profile')->get();

		return View::make('users.index', compact('users'));
	}

	/**
     * Show the specified user.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $user = $this->user->with('profile')->findOrFail($id);

        return View::make('users.show', compact('user'));
    }
}
