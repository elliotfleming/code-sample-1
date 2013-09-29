<?php

class Setting extends Eloquent
{
    protected $fillable = array('*');

    /**
     * Soft Delete adds a deleted_at timestamp on the record
     *
     * @var boolean
     */
    protected $softDelete = true;

    public function users()
    {
        return $this->belongsTo('User');
    }
}
