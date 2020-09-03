<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class _class extends Model
{
    protected $table = 'Classes';
    protected $primaryKey = 'class_id';
    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'string';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    // protected $guard = '_class';

    /**
     * The attributes that are mass assignable.
     * NoS number of sessions
     * @var array
     */
    protected $fillable = [
        'class_id',
        'name',
        'NoS',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at', 'updated_at'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [];
}
