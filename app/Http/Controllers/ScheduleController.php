<?php

namespace App\Http\Controllers;

use App\_class;
use App\Course;
use App\Event;
use App\Subject;
use Illuminate\Support\Facades\DB;

class ScheduleController extends Controller
{
    protected $class_name = [
        'btn btn-primary text-white',
        'btn btn-secondary',
        'btn btn-success',
        'btn btn-warning',
        'btn btn-info text-white',
        'btn btn-outline-dark',
    ];

    public function getEvents($class_id)
    {
        $class = _class::where('class_id', $class_id)->first();
        $period = DB::table('period')->where('id', $class->period_id)->first();
        $course = Course::where('course_id', $class->course_id)->first();
        $subjects = $course->getSubjects();
        $events = array();
        $start_day = $class->start_day;
        $DoW = [$class->DoW];
        $i = 0;
        while (true) {
            $next = $DoW[$i++] + $class->step;
            if ($next > 6) {
                break;
            }
            array_push($DoW, $next);
        }

        $start = date_create($start_day);
        switch (date_format($start, 'w')) {
            case "1":
            case "3":
            case "5":
                if ($class->DoW == 2) {
                    $start_day = date_format(date_add($start, date_interval_create_from_date_string(1 . " days")), "Y-m-d");
                }
                break;
            case "2":
            case "4":
                if ($class->DoW == 1) {
                    $start_day = date_format(date_add($start, date_interval_create_from_date_string(1 . " days")), "Y-m-d");
                }
                break;
            default:
                # code...
                break;
        }

        foreach ($subjects as $s) {
            $sub = Subject::where('subject_id', $s->subject_id)->first();
            $event = new Event();
            $event->groupId = $class_id;
            $event->title = $s->subject_id;
            $event->daysOfWeek = $DoW;
            $event->startRecur = $start_day;
            $event->endRecur = date_format($sub->calcEndDay($start_day, $class->step), "Y-m-d");
            $event->startTime = $period->start_time;
            $event->endTime = $period->end_time;
            $event->classNames = [$this->class_name[array_rand($this->class_name, 1)]];
            array_push($events, $event);
            $endDay = $sub->calcEndDay($start_day, $class->step);
            $start_day = date_format($this->nextStartday($endDay, $class->step), "Y-m-d");
        }


        return response()->json($events);
    }

    static public function nextStartday($endDay, $step = null)
    {
        if (date_format($endDay, 'w') == 0 || date_format($endDay, 'w') == 6) {
            return date_add($endDay, date_interval_create_from_date_string($step . " days"));
        } else {
            // return date_add($endDay, date_interval_create_from_date_string(1 . " days"));
            return $endDay;
        }
    }
}
