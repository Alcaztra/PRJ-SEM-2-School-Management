<?php

namespace App\Http\Controllers;

use App\Course;
use App\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CourseController extends Controller
{
    public static function getCourses()
    {
        return Course::all();
    }

    public function listCourses()
    {
        $subjects = DB::table('semesters')
            ->leftJoin('subjects', 'subjects.subject_id', '=', 'semesters.subject_id')
            ->get();
        return view('pages.courses.list-courses', ['courses' => $this->getCourses(), 'subjects' => $subjects]);
    }

    public function showFormCreateCourse()
    {
        $subjects = Subject::all();
        return view('pages.courses.create-course', ['subjects' => $subjects]);
    }

    public function createCourse(Request $request)
    {
        $validatedData = $request->validate([
            'course_id' => 'required|unique:courses,course_id|max:255',
            'name' => 'required',
        ]);
        for ($i = 1; $i <= 4; $i++) {
            if ($request->has("semester_$i")) {
                $sem = $request->input("semester_$i");
                // dd($sem_1);
                foreach ($sem as $value) {
                    DB::table('semesters')->insert(['course_id' => $request->course_id, 'semester' => $i, 'subject_id' => $value]);
                }
            }
        }

        $course = new Course();
        $course->course_id = $request->course_id;
        $course->name = $request->name;
        $course->save();

        return redirect(route('course.list'));
    }

    public function showFormCourseDetails($course_id)
    {
        for ($i = 1; $i <= 4; $i++) {
            $subjects_sem[$i] = DB::table('semesters')
                ->where(['course_id' => $course_id, 'semester' => $i])
                ->leftJoin('subjects', 'subjects.subject_id', '=', 'semesters.subject_id')
                ->select(['semester', 'subjects.subject_id', 'subjects.name'])
                ->get();
        }

        $course = Course::where('course_id', $course_id)->first();

        return view('pages.courses.course-details')->with([
            'subjects' => Subject::all(),
            'sub_sem' => [
                1 => $subjects_sem[1],
                2 => $subjects_sem[2],
                3 => $subjects_sem[3],
                4 => $subjects_sem[4],
            ],
            'course' => $course,
        ]);
    }

    public function courseDetails(Request $request)
    {
        $course_id = $request->course_id;

        for ($i = 1; $i <= 4; $i++) {
            if ($request->has("semester_$i")) {
                $sem = $request->input("semester_$i");
                $subjects_sem = DB::table('semesters')
                    ->where(['course_id' => $course_id, 'semester' => $i])
                    ->select(['id', 'subject_id'])
                    ->get();

                // }

                // foreach ($sem as $value) {
                //     DB::table('semesters')->insert(['course_id' => $request->course_id, 'semester' => $i, 'subject_id' => $value]);
                // }
            }
        }
        // $course = Course::where('course_id', $course_id);
        // $course->name = $request->name;
        // $course->save();

        // return redirect(route('course.list'));
    }
}
