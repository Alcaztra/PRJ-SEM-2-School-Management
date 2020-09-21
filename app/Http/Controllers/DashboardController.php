<?php

namespace App\Http\Controllers;

use App\_class;
use App\Course;
use App\Student;
use App\Subject;
use App\Teacher;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

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
                    // dd($enroll_subject);
                    return view('student-site.pages.dashboard')->with(['class' => $class, 'course' => $course, 'enroll_subject' => $enroll_subject, 'enrolled' => $enrolled]);
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
