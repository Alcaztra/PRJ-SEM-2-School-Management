<?php

namespace App\Http\Controllers;

use App\_class;
use App\Course;
use Illuminate\Http\Request;

class ClassController extends Controller
{
    public function listClasses()
    {
        $classes = _class::all();
        return view('pages.classes.list-classes')->with('classes', $classes);
    }

    public function showFormCreateClass()
    {
        $courses = Course::all();
        return view('pages.classes.create-class', ['courses' => $courses]);
    }

    public function createClass(Request $request)
    {
        $class = new _class();
        $class->class_id = $request->class_id;
        $class->room = $request->room;
        $class->start_day = $request->start_day;
        $class->course_id = $request->course_id;
        $class->total_duration = $class->calcDuration();
        $class->step = 2;

        $class->save();

        return redirect()->intended(route('class.list'));
    }
}
