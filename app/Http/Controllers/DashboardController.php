<?php

namespace App\Http\Controllers;

use App\_class;
use App\Course;
use App\Student;
use App\Subject;
use App\Teacher;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        date_default_timezone_set("Asia/Ho_Chi_minh");
        $host = request()->getHost();
        switch ($host) {
            case 'localhost':
                $counts = ['students', 'teachers', 'courses', 'classes', 'subjects'];
                $counts['students'] = Student::all()->count();
                $counts['teachers'] = Teacher::all()->count();
                $counts['courses'] = Course::all()->count();
                $counts['classes'] = _class::all()->count();
                $counts['subjects'] = Subject::all()->count();
                $classes = _class::all();
                return view('pages.dashboard', ['counts' => $counts, 'classes' => $classes]);
                break;
            case 'student.localhost':
                $user = Auth::guard('student')->user();
                $enroll_subject = array();
                if (isset($user->class_id) && "" !== $user->class_id) {
                    $class = _class::where('class_id', $user->class_id)->first();
                    $course = Course::where('course_id', $class->course_id)->first();
                    // $enroll_subject sub_id sub_name
                    $enrolled = DB::table('enrollment')
                        ->where('student_id', $user->user_id)
                        ->leftJoin('subjects', 'subjects.subject_id', '=', 'enrollment.subject_id')
                        ->select('enrollment.subject_id', 'name')
                        ->get();
                    $sub = $course->getSubjects();
                    if ($enrolled->count() > 0) {
                        // dump($enrolled, $sub);
                        foreach ($sub as $s) {
                            // dump($enrolled->contains('subject_id',$s->subject_id));
                            if (!$enrolled->contains('subject_id', $s->subject_id)) {
                                array_push($enroll_subject, $s);
                            }
                        }
                    } else {
                        $enroll_subject = $sub;
                    }

                    $now = date('Y-m-d');
                    // dd(strtotime($now));
                    $start_day = $class->start_day;
                    $curr_sub = null;
                    $next_sub = null;
                    foreach ($sub as $s) {
                        $subject = Subject::where('subject_id', $s->subject_id)->first();
                        $end_day = $subject->calcEndDay($start_day, $class->step);

                        // dump($s, $start_day, date_format($end_day, "Y-m-d"), $now >= $start_day && $now <= date_format($end_day, "Y-m-d"));
                        if ($now >= $start_day && $now <= date_format($end_day, "Y-m-d")) {
                            $curr_sub = $subject;
                            $next = DB::table('semesters')->where(['course_id' => $class->course_id, 'semester' => $s->semester, 'subject_order' => $s->subject_order + 1])->first();
                            $next_sub = Subject::where('subject_id', $next->subject_id)->first();
                            break;
                        }
                        $start_day = date_format(ScheduleController::nextStartday($subject->calcEndDay($start_day, $class->step), $class->step), "Y-m-d");
                    }
                    // dd($enroll_subject);
                    return view('student-site.pages.dashboard')->with([
                        'class' => $class,
                        'course' => $course,
                        'enroll_subject' => $enroll_subject,
                        'enrolled' => $enrolled,
                        'current_subject' => $curr_sub,
                        'next_subject' => $next_sub,
                        'next_exam' => date_format($end_day, "Y,M d"),
                    ]);
                } else {
                    return view('student-site.pages.dashboard');
                }

                break;
            case 'teacher.localhost':
                $classes = Auth::guard('teacher')->user()->getClasses();
                // dd($classes);
                return view('teacher-site.pages.dashboard')->with(['classes' => $classes]);
                break;
        }
    }
}
