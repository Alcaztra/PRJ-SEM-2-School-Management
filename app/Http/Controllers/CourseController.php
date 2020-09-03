<?php

namespace App\Http\Controllers;

use App\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function listCourses()
    {
        $courses = Course::all();
        return view('pages.courses.list-courses')->with('courses', $courses);
    }

    public function showFormCreateCourse()
    {
        return view('pages.courses.create-course');
    }
    public function createCourse(Request $request)
    {
        $course = new Course();
        $course->course_id = $request->course_id;
        $course->name = $request->name;
        $course->save();

        return redirect()->intended(route('course.list'));
    }
}
