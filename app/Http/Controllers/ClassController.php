<?php

namespace App\Http\Controllers;

use App\_class;
use App\Course;
use App\Student;
use App\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClassController extends Controller
{
    public function getClasses()
    {
        return _class::all();
    }

    public function listClasses()
    {
        return view('pages.classes.list-classes')->with('classes', $this->getClasses());
    }

    public function showFormCreateClass()
    {
        $courses = Course::all();
        return view('pages.classes.create-class', ['courses' => $courses]);
    }

    public function createClass(Request $request)
    {
        $validatedData = $request->validate([
            'class_id' => 'required|max:50',
            'room' => 'required|size:10|numeric',
        ]);
        $class = new _class();
        $class->class_id = $request->class_id;
        $class->room = $request->room;
        $class->start_day = $request->start_day;
        $class->course_id = $request->course_id;
        $class->total_duration = $class->calcDuration();
        $class->step = 2;

        $class->save();

        return redirect(route('class.list'));
    }

    public function showFormAddUser()
    {
        $classes = _class::all();
        $teachers = Teacher::all();
        return view('pages.classes.add-user', ['classes' => $classes, 'teachers' => $teachers]);
    }

    public function addUser(Request $request)
    {
        $class_id = $request->class_id;
        $teacher = $request->teacher_id;
        DB::table('class-management')->insert(['class_id' => $class_id, 'user_id' => $teacher]);
        $students = $request->students;
        foreach ($students as $s) {
            DB::table('class-management')->insert(['class_id' => $class_id, 'user_id' => $s]);
        }
        return redirect(route('class.list'));
    }
}
