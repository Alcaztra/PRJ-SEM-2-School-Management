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
    public static function getClasses()
    {
        return _class::all();
    }

    public function getTeacher($class_id)
    {
        return DB::table('class-management')
            ->where('class_id', $class_id)
            ->select('teacher_id')
            ->get();
    }

    public function getStudents($class_id)
    {
        return Student::where('class_id', $class_id)->select(['user_id', 'name'])->get();
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
        $class = new _class();
        $class->class_id = $request->class_id;
        $class->room = $request->room;
        // $class->max_size = $request->max_size;
        $class->DoW = $request->DoW;
        $class->period_id = $request->period_id;
        $class->start_day = $request->start_day;
        $class->course_id = $request->course_id;
        // $class->total_duration = $class->calcDuration();
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
        // date_default_timezone_set("Asia/Ho_Chi_Minh");
        // dd(now("Asia/Ho_Chi_Minh"));
        $class_id = $request->class_id;

        // dd($request);
        if (isset($request->teacher_id)) {
            $teacher_id = $request->teacher_id;
            if (DB::table('class-management')->where('class_id', $class_id)->count() == 0) {
                DB::table('class-management')->insert(['class_id' => $class_id, 'teacher_id' => $teacher_id, 'created_at' => now("Asia/Ho_Chi_Minh")]);
            } else {
                DB::table('class-management')->where(['class_id' => $class_id])->update(['teacher_id' => $teacher_id, 'updated_at' => now("Asia/Ho_Chi_Minh")]);
            }
        }

        if ($request->has('students')) {
            $students = $request->students;
            foreach ($students as $s) {
                DB::table('students')->where('user_id', $s)->update(['class_id' => $class_id, 'updated_at' => now("Asia/Ho_Chi_Minh")]);
            }
            $class = _class::where('class_id', $class_id)->first();
            $class->size = $class->calcSize();
            $class->save();
        }

        return redirect(route('class.list'));
    }

    public function showFormClassDetails($class_id)
    {
        $class = _class::where('class_id', $class_id)->first();
        $students = DB::table('students')
            ->where('class_id', $class_id)
            ->get();
        return view('pages.classes.class-details')->with(['class' => $class, 'courses' => CourseController::getCourses(), 'students' => $students]);
    }

    public function classDetails(Request $request)
    {
        // dump($request);
        $class = _class::where('class_id', $request->class_id)->first();
        $class->room = $request->room;
        // $class->max_size = $request->max_size;
        $class->DoW = $request->DoW;
        $class->period_id = $request->period_id;
        $class->start_day = $request->start_day;
        $class->course_id = $request->course_id;
        // $class->total_duration = $class->calcDuration();

        $class->save();

        return back();
    }
}
