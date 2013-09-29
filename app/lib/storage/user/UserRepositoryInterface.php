<?php namespace EveryEquity\Storage\User;

interface UserRepositoryInterface
{
    public function all();

    public function find($id);

    public function create($input);
}
