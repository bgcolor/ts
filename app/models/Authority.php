<?php 
class Authority extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'authority';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = array();
    protected $guarded = array();
    public $timestamps = false;
}