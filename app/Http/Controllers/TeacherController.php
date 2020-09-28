<?php

namespace App\Http\Controllers;

use App\_class;
use App\Course;
use App\Http\Requests\UserProfile;
use App\Subject;
use App\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller
{
    public static function getTeachers()
    {
        return Teacher::all();;
    }

    public function listTeachers()
    {
        return view('pages.teachers.list-teachers')->with('teachers', $this->getTeachers());
    }

    public function showFormCreateTeacher()
    {
        return view('pages.teachers.create-teacher');
    }

    public function createTeacher(UserProfile $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'bail|required|regex:/[a-zA-Z0-9]*/|unique:teachers,user_id|max:50',
            
        ]);
        $teacher = new Teacher();
        $teacher->user_id = $request->user_id;
        $teacher->name = $request->name;
        $teacher->gender = $request->gender;
        $teacher->email = $request->email;
        $teacher->phone = $request->phone;
        $teacher->birthday = $request->birthday;
        $teacher->address = $request->address;

        $teacher->save();
        return redirect(route('teacher.list'));
    }

    public function showTeacherDetails($teacher_id)
    {
        $teacher = Teacher::where('user_id', $teacher_id)->first();
        return view('pages.teachers.teacher-details')->with('teacher', $teacher);
    }

    public function resetPassword($teacher_id)
    {
        $teacher = Teacher::where('user_id', $teacher_id)
            ->first();
        $teacher->password = Hash::make('password');
        $teacher->save();
        $result = Hash::check('password', Teacher::find($teacher)->first()->password);

        return back()->with('result', $result);
    }

    public function getClassDetails($class_id)
    {
        $tmp = _class::where('class_id', $class_id)->first();
        $class = [
            'class_id' => $tmp->class_id,
            'room' => $tmp->room,
            'size' => $tmp->calcSize(),
            'course' => $tmp->course_id . " | " . $tmp->getCourse()->name,
            'study_shift' => $tmp->getStudyShift(),
            'period' => $tmp->getPeriod()->start_time . ' => ' . $tmp->getPeriod()->end_time,
            'total_duration' => $tmp->calcDuration() . " (hours)",
            'start_day' => $tmp->start_day,
            'end_day' => $tmp->getEndDay(),
        ];
        return $class;
    }

    public function getListSubjects($class_id)
    {
        $class = _class::where('class_id', $class_id)->first();
        $course = Course::where('course_id', $class->course_id)->first();
        return $course->getSubjects();
    }

    public function getSessions($subject_id)
    {
        return Subject::where('subject_id', $subject_id)->first()->sessions;
    }

    /* public function tmp()
    {
        $data = array();
        $class = _class::where('class_id', $class_id)->first();
        $course = Course::where('course_id', $class->course_id)->first();
        $start_day = $class->start_day;

        // get order list subjects
        $subjects = $course->getSubjects();
        // get order of current subject
        $curr_sub_pos = DB::table('semesters')->where(['course_id' => $class->course_id, 'subject_id' => $subject_id])->first();

        $sessions_before = 0;
        foreach ($subjects as $s) {
            if ($s->semester < $curr_sub_pos->semester && $s->subject_order < $curr_sub_pos->subject_order) {
                $sub = Subject::where('subject_id', $s->subject_id)->first();
                $sessions_before += $sub->sessions;
            } else if ($s->semester == $curr_sub_pos->semester && $s->subject_order == $curr_sub_pos->subject_order) {
                break;
            }
        }

        // calculate days before
        $days = round($sessions_before / 2, 0, PHP_ROUND_HALF_UP);
        $start = date_create($start_day);
        $end = null;
        for ($i = 0; $i < ($days - 1); $i++) {
            // calculate next day
            if (date_format($start, 'w') == 5 || date_format($start, 'w') == 6) {
                $end = date_add($start, date_interval_create_from_date_string(1 . " days"));
            }
            $end = date_add($start, date_interval_create_from_date_string($class->step . " days"));
            if (date_format($end, 'w') == 5 || date_format($end, 'w') == 6) {
                $end = date_add($start, date_interval_create_from_date_string(1 . " days"));
            }
        }
        // $end = date_add($start, date_interval_create_from_date_string(1 . " days"));

        $curr_sessions = Subject::where('subject_id', $subject_id)->first()->duration;

        $days = round($curr_sessions / 2, 0, PHP_ROUND_HALF_UP);
        $start = $end;
        for ($i = 0; $i < $days; $i++) {
            // calculate next day
            if (date_format($start, 'w') == 5 || date_format($start, 'w') == 6) {
                $end = date_add($start, date_interval_create_from_date_string(1 . " days"));
                array_push($data, []);
            }
            $end = date_add($start, date_interval_create_from_date_string($class->step . " days"));
            if (date_format($end, 'w') == 5 || date_format($end, 'w') == 6) {
                $end = date_add($start, date_interval_create_from_date_string(1 . " days"));
            }
        }
    } */

    // public function getListStudents($class_id, $subject_id, $date_picker)
    public function getListStudents($class_id, $subject_id, $session)
    {
        $data = array();
        date_default_timezone_set("Asia/Ho_Chi_Minh");

        $students = DB::table('enrollment')
            ->where('enrollment.class_id', $class_id)
            ->where('subject_id', $subject_id)
            ->leftJoin('students', 'user_id', '=', 'student_id')
            ->select(['user_id', 'name'])
            ->get();

        foreach ($students as $s) {
            $checked = DB::table('attendance')
                ->where(['student_id' => $s->user_id, 'subject_id' => $subject_id, 'session' => $session])
                ->get();
            if ($checked->count() !== 0) {
                foreach ($checked as $c) {
                    array_push($data, ['user_id' => $s->user_id, 'name' => $s->name, 'status' => $c->status]);
                }
            } else {
                // return student
                // $stu = Student::where('user_id', $s->user_id)->first();
                array_push($data, ['user_id' => $s->user_id, 'name' => $s->name, 'status' => 0]);
            }
        }

        return $data;
    }

    public function postAttendance(Request $request, $subject_id, $session)
    {
        $update = $result = 0;
        $status = $request->status;
        foreach ($status as $s) {
            $checked = DB::table('attendance')
                ->where(['student_id' => $s['name'], 'subject_id' => $subject_id, 'session' => $session])
                ->get();
            if ($checked->count() == 0) {
                $result = DB::table('attendance')->insert([
                    'student_id' => $s['name'],
                    'subject_id' => $subject_id,
                    'session' => $session,
                    'status' => $s['value'],
                    'created_at' => now("Asia/Ho_Chi_Minh")
                ]);
            } else {
                $result = DB::table('attendance')
                    ->where(['student_id' => $s['name'], 'subject_id' => $subject_id, 'session' => $session])
                    ->update(['status' => $s['value'], 'created_at' => now("Asia/Ho_Chi_Minh")]);
            }
        }
        // return view('test', ['data' => $request->status]);
        return [intval($result), $update];
    }
}
