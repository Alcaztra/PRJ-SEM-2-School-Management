<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

class Teacher extends Authenticatable
{
    use Notifiable;

    protected $table = 'Teachers';
    protected $primaryKey = 'user_id';
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

    protected $guard = 'teacher';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'name',
        'avatar',
        'gender',
        'email',
        'phone',
        'birthday',
        'address',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'created_at', 'updated_at'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'birthday' => 'date'
    ];

    public function getClasses()
    {
        $classes = array();
        $class_id = DB::table('class-management')->where('teacher_id', $this->user_id)->select('class_id')->get();
        foreach ($class_id as $c) {
            array_push($classes, _class::where('class_id', $c->class_id)->first());
        }
        return $classes;
    }
}
