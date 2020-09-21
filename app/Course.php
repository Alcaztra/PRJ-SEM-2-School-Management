<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Course extends Model
{
    protected $table = 'Courses';
    protected $primaryKey = 'course_id';
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

    // protected $guard = 'course';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'course_id',
        'name',
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

    /**
     * Get all subjects of course
     * 
     * @return array
     */
    public function getSubjects()
    {
        return DB::table('semesters')->where('course_id', $this->course_id)
            ->leftJoin('subjects', 'semesters.subject_id', '=', 'subjects.subject_id')
            ->select('semesters.subject_id', 'name', 'semester')
            ->get();
    }
}
