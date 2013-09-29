<?php

class Privacy extends Eloquent
{
    protected $fillable = array('*');

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'privacy';

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
