<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $table = 'Subjects';
    protected $primaryKey = 'subject_id';
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

    // protected $guard = 'subject';

    /**
     * The attributes that are mass assignable.
     * 
     * @var array
     */
    protected $fillable = [
        'subject_id',
        'name',
        'sessions',
        'duration',
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
     * Calculate the end day of subject
     * 
     * @method calcEndDay($start_day, $step)
     * @param string start_day
     * @param int step
     * @return Datetime object
     */
    public function calcEndDay($start_day, $step)
    {
        $start = date_create($start_day);
        if ($this->sessions > 0) {
            $days = round($this->sessions / 2, 0, PHP_ROUND_HALF_UP);
        } else {
            return $start;
        }

        for ($i = 0; $i < ($days - 1); $i++) {
            // calculate next day
            if (date_format($start, 'w') == 5 || date_format($start, 'w') == 6) {
                $end = date_add($start, date_interval_create_from_date_string(1 . " days"));
            }
            $end = date_add($start, date_interval_create_from_date_string($step . " days"));
            if (date_format($end, 'w') == 5 || date_format($end, 'w') == 6) {
                $end = date_add($start, date_interval_create_from_date_string(1 . " days"));
            }
        }
        $end = date_add($start, date_interval_create_from_date_string(1 . " days"));
        return $end;
    }

}
