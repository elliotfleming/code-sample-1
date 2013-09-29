<?php

class Profile extends Eloquent
{
    protected $fillable = array('*');

    /**
     * Soft Delete adds a deleted_at timestamp on the record
     *
     * @var boolean
     */
    protected $softDelete = false;

    public function users()
    {
        return $this->belongsTo('User');
    }
}
