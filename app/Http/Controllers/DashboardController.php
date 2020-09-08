<?php

namespace App\Http\Controllers;

use App\_class;
use App\Course;
use App\Student;
use App\Subject;
use App\Teacher;
use Illuminate\Support\Facades\Auth;
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
        $this->middleware('auth:admin');
        // debug
        // dd('dashboard', Auth::guard('admin')->user(), Auth::guard('admin')->check(), Session::all());
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::guard('admin')->user();
        $counts = ['students', 'teachers', 'courses', 'classes', 'subjects'];
        $counts['students'] = Student::all()->count();
        $counts['teachers'] = Teacher::all()->count();
        $counts['courses'] = Course::all()->count();
        $counts['classes'] = _class::all()->count();
        $counts['subjects'] = Subject::all()->count();
        return view('pages.dashboard', ['counts' => $counts]);
    }
}
