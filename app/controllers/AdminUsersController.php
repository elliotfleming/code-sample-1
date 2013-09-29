<?php

class AdminUsersController extends BaseController
{
    /**
     * User Repository
     *
     * @var User
     */
    protected $user;

    public function __construct(User $user)
    {
        parent::__construct();
        
        $this->beforeFilter('auth');
        $this->beforeFilter('authority.read:Users');

        $this->user = $user;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        /// Eager load permissions to reduce # of queries (by Authority)
        $users = $this->user->withTrashed()->with('roles', 'profile')->get();

        return View::make('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return View::make('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $input = Input::all();
        $validation = Validator::make($input, User::$rules);

        if ($validation->passes())
        {
            $this->user->create($input);

            return Redirect::to('admin/users');
        }

        return Redirect::route('admin.users.create')
            ->withInput()
            ->withErrors($validation)
            ->with('message', 'There were validation errors.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $user = $this->user->findOrFail($id);

        return View::make('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $user = $this->user->find($id);

        if (is_null($user))
        {
            return Redirect::route('admin.users.index');
        }

        return View::make('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        $input = array_except(Input::all(), '_method');
        $validation = Validator::make($input, User::$rules);

        if ($validation->passes())
        {
            $user = $this->user->find($id);
            $user->update($input);

            return Redirect::route('admin.users.show', $id);
        }

        return Redirect::route('admin.users.edit', $id)
            ->withInput()
            ->withErrors($validation)
            ->with('message', 'There were validation errors.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $user = $this->user->find($id);

        if (Authority::can('delete', 'User', $user))
        {
            $user->delete();
            Notification::success($user->email . ' was successfully deleted');

            return Redirect::route('admin.users.index');
        }

        Notification::error('You do not have permission to delete ' . $user->email);

        return Redirect::route('admin.users.index');
    }

    public function restore($id)
    {
        $user = $this->user->withTrashed()->find($id);
        $user->restore();

        Notification::success($user->email . ' was successfully restored');

        return Redirect::route('admin.users.index');
    }
}
