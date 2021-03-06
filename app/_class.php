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
     * 
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
     * @return DateTime object
     */
    public function calcEndDay()
    {
        $start = date_create($this->start_day);
        if ($this->calcDuration() > 0) {
            $days = round($this->calcDuration() / 4, 0, PHP_ROUND_HALF_UP);
        } else {
            return $start;
        }

        // total days left (days - 1)
        for ($i = 0; $i < $days - 1; $i++) {
            // calculate next day
            if (date_format($start, 'w') == 5 || date_format($start, 'w') == 6) {
                $end = date_add($start, date_interval_create_from_date_string(1 . " days"));
            }
            $end = date_add($start, date_interval_create_from_date_string($this->step . " days"));
            if (date_format($end, 'w') == 5 || date_format($end, 'w') == 6) {
                $end = date_add($start, date_interval_create_from_date_string(1 . " days"));
            }
        }
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

    public function getPeriod()
    {
        $period = DB::table('period')->where('id', $this->period_id)->select(['start_time', 'end_time'])->first();
        return $period;
    }

    public function getCourse()
    {
        $course_name = Course::where('course_id', $this->course_id)->select('name')->first();
        return $course_name;
    }

    public function getStudyShift()
    {
        switch ($this->DoW) {
            case 1:
                return 'Tue / Thu / Sat';
            case 2:
                return 'Mon / Wed / Fri';
        }
    }
}
