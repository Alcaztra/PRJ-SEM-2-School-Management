<?php

namespace App\Http\Controllers;

use App\Course;
use App\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CourseController extends Controller
{
    public function listCourses()
    {
        $courses = Course::all();
        $subjects = DB::table('semesters')
            ->leftJoin('subjects', 'subjects.subject_id', '=', 'semesters.subject_id')
            ->get();
        return view('pages.courses.list-courses', ['courses' => $courses, 'subjects' => $subjects]);
    }

    public function showFormCreateCourse()
    {
        $subjects = Subject::all();
        return view('pages.courses.create-course', ['subjects' => $subjects]);
    }

    public function createCourse(Request $request)
    {
        if ($request->has("semester_1")) {
            $sem_1 = $request->semester_1;
            // dd($sem_1);
            foreach ($sem_1 as $value) {
                DB::table('semesters')->insert(['course_id' => $request->course_id, 'semester' => 1, 'subject_id' => $value]);
            }
        }
        if ($request->has("semester_2")) {
            $sem_2 = $request->semester_2;
            foreach ($sem_2 as $value) {
                DB::table('semesters')->insert(['course_id' => $request->course_id, 'semester' =>  2, 'subject_id' => $value]);
            }
        }
        if ($request->has("semester_3")) {
            $sem_3 = $request->semester_3;
            foreach ($sem_3 as $value) {
                DB::table('semesters')->insert(['course_id' => $request->course_id, 'semester' =>  3, 'subject_id' => $value]);
            }
        }
        if ($request->has("semester_4")) {
            $sem_4 = $request->semester_4;
            foreach ($sem_4 as $value) {
                DB::table('semesters')->insert(['course_id' => $request->course_id, 'semester' =>  4, 'subject_id' => $value]);
            }
        }
        // dd($sem_1, $sem_2);
        $course = new Course();
        $course->course_id = $request->course_id;
        $course->name = $request->name;
        $course->save();

        return redirect(route('course.list'));
    }
}
