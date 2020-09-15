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

                return view('pages.dashboard', ['counts' => $counts]);
                break;
            case 'student.localhost':
                $class_id = Auth::guard('student')->user()->class_id;
                $class = _class::where('class_id', $class_id)->first();
                $course = Course::where('course_id', $class->course_id)->first();
                return view('student-site.pages.dashboard')->with(['class' => $class, 'course' => $course]);
                break;
            case 'teacher.localhost':
                $classes = Auth::guard('teacher')->user()->getClasses();
                // dd($classes);
                return view('teacher-site.pages.dashboard')->with(['classes' => $classes]);
                break;
        }
    }
}
