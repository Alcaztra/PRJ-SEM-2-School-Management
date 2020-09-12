<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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
        'room',
        // 'max_size',
        'course_id',
        'DoW',
        'period_id',
        'start_day',
        // 'total_duration',
        'step',
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
     * Calculate total duration
     * 
     * @param string $course_id
     * @return integer $sum
     */
    public function calcDuration()
    {
        $duration = DB::table('semesters')
            ->leftJoin('subjects', 'subjects.subject_id', '=', 'semesters.subject_id')
            ->where('course_id', $this->course_id)
            ->select('subjects.subject_id', 'duration')
            ->get();
        $sum = 0;
        // dd($duration);
        foreach ($duration as $d) {
            $sum = $sum + $d->duration;
        }
        return $sum;
    }

    /**
     * Calculate class size
     * 
     * @return integer $size
     */
    public function calcSize()
    {
        $size = 0;
        $size = DB::table('students')->where('class_id', '=', $this->class_id)->count('user_id');
        // dd($size);
        return $size;
    }

    /**
     * Calculate the expected end date
     * 
     * @return object end_day
     */
    public function calcEndDay()
    {
        $days = round($this->calcDuration() / 4, 0, PHP_ROUND_HALF_UP);
        $start = date_create($this->start_day);
        $i = 0;

        do {
            // calculate next day
            $end = date_add($start, date_interval_create_from_date_string($this->step . " days"));
            $i++;
            if ($this->step == 2 && $i == 3) {
                $end = date_add($start, date_interval_create_from_date_string(1 . " days"));
                $i = 0;
            }
        } while (--$days > 1); // total days left (days - 1)
        return $end;
    }

    public function getEndDay()
    {
        return date_format($this->calcEndDay(), "Y-m-d");
    }

    public function getTeacher()
    {
        $teacher = DB::table('class-management')
            ->leftJoin('teachers', 'user_id', '=', 'teacher_id')
            ->where('class_id', $this->class_id)
            ->select('user_id', 'name')
            ->first();
        return $teacher;
    }
}
