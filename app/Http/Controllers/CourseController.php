<?php

namespace App\Http\Controllers;

use App\Course;
use App\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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
            'course_id' => 'bail|regex:/[a-zA-Z0-9 ]*/|unique:courses,course_id',
            'name' => 'bail|regex:/[a-zA-Z0-9 ]*/',
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

        return redirect(route('course.details', ['course_id' => $course->course_id]));
    }

    function subjects_sem($course_id)
    {
        for ($i = 1; $i <= 4; $i++) {
            $subjects_sem[$i] = DB::table('semesters')
                ->where(['course_id' => $course_id, 'semester' => $i])
                ->leftJoin('subjects', 'subjects.subject_id', '=', 'semesters.subject_id')
                ->select(['semester', 'subject_order', 'subjects.subject_id', 'subjects.name'])
                ->orderBy('subject_order')
                ->get();
        }
        return  [
            1 => $subjects_sem[1],
            2 => $subjects_sem[2],
            3 => $subjects_sem[3],
            4 => $subjects_sem[4],
        ];
    }

    public function showFormCourseDetails($course_id)
    {
        $course = Course::where('course_id', $course_id)->first();

        return view('pages.courses.course-details')->with([
            'subjects' => Subject::all(),
            'sub_sem' => $this->subjects_sem($course_id),
            'course' => $course,
        ]);
    }

    public function courseDetails(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'bail|regex:/[a-zA-Z0-9 ]*/',
        ]);
        $course_id = $request->course_id;

        for ($i = 1; $i <= 4; $i++) {
            // get list subjects from DB
            $sub_db = DB::table('semesters')
                ->where(['course_id' => $course_id, 'semester' => $i])
                ->select(['id', 'subject_id'])
                ->get();
            if ($sub_db->isNotEmpty()) {
                // exists subjects in db
                if ($request->has("semester_$i")) {
                    // get list subjects from request
                    $sub_rq = $request->input("semester_$i");
                    foreach ($sub_rq as $s_rq) {
                        if (!$sub_db->contains('subject_id', $s_rq)) {
                            DB::table('semesters')->insert(['course_id' => $course_id, 'semester' => $i, 'subject_id' => $s_rq, 'created_at' => now("Asia/Ho_Chi_Minh")]);
                        }
                    }
                    foreach ($sub_db as $s_db) {
                        if (!in_array($s_db->subject_id, $sub_rq)) {
                            DB::table('semesters')->where('id', $s_db->id)->delete();
                        }
                    }
                } else {
                    // all subjects in semester from reqest is not exists
                    foreach ($sub_db as $s_db) {
                        DB::table('semesters')->where('id', $s_db->id)->delete();
                    }
                }
            } elseif ($request->has("semester_$i")) {
                // subjects not exists in db, request add all
                $sub_rq = $request->input("semester_$i");
                foreach ($sub_rq as $s_rq) {
                    DB::table('semesters')->insert(['course_id' => $course_id, 'semester' => $i, 'subject_id' => $s_rq, 'created_at' => now("Asia/Ho_Chi_Minh")]);
                }
            }
        }
        $course = Course::where('course_id', $course_id)->first();
        // dd($course);
        $course->name = $request->name;
        $course->save();

        return redirect(route('course.list'));
    }


    /*     public function showSubjectsOrder($course_id)
    {
        return view('layout.subjects-order-list', ['sub_sem' => $this->subjects_sem($course_id)])->render();
    } */

    public function postOrder(Request $request)
    {
        $rows = 0;
        $subjects = $request['subjects'];
        foreach ($subjects as $s) {
            $rows = DB::table('semesters')
                ->where(['course_id' => $s['course_id'], 'semester' => $s['semester'], 'subject_id' => $s['subject_id']])
                ->update(['subject_order' => $s['subject_order']]);
        }
        // return  view('test', ['data' => $request->all(),$rows]])->render();
        return response($rows);
    }
}
