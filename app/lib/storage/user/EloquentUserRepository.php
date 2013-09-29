<?php namespace EveryEquity\Storage\User;

use User; // Could also inject this instead

class EloquentUserRepository implements UserRepositoryInterface
{
    public function all()
    {
        return User::all();
    }

    public function find($id)
    {
        return User::find($id);
    }

    public function create($input)
    {
        return User::create($input);
    }
}
