<?php

class Role extends Eloquent
{
	protected $fillable = array('name');

	public function users()
    {
        return $this->belongsToMany('User');
    }
}
