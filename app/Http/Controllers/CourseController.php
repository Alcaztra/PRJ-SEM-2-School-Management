<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function listCourses()
    {
        return view('pages.courses.list-courses');
    }

    public function showFormCreateCourse()
    {
        return view('pages.courses.create-course');
    }
}
