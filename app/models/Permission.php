<?php

class Permission extends Eloquent
{
	protected $fillable = array('user_id', 'type', 'action', 'resource');

	public function users()
    {
        return $this->belongsTo('User');
    }
}
