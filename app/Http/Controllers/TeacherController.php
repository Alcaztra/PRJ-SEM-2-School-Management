<?php

namespace App\Http\Controllers;

use App\_class;
use App\Course;
use App\Student;
use App\Teacher;
use DateTimeZone;
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

    public function createTecher(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'bail|required|regex:/[a-zA-Z0-9]*/|unique:teachers,user_id|max:50',
            'name' => 'bail|required|regex:/[a-zA-Z0-9 ]*/|max:255',
            'gender' => 'bail|required',
            'email' => 'bail|required|regex:/[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$/',
            'phone' => 'bail|required|regex:/^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[\s\d]*$/|min:8|max:14',
            'birthday' => 'bail|required|date|before:-16 years',
            'address' => 'bail|required',
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

    public function getListStudents($class_id, $subject_id, $date_picker)
    {
        $data = array();
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        $students = DB::table('enrollment')
            ->where('enrollment.class_id', $class_id)
            ->where('subject_id', $subject_id)
            ->leftJoin('students', 'user_id', '=', 'student_id')
            ->select(['user_id', 'name'])
            ->get();
        $date_before = date_sub(date_create($date_picker), date_interval_create_from_date_string("1 days"));
        $date_after = date_add(date_create($date_picker), date_interval_create_from_date_string("1 days"));
        foreach ($students as $s) {
            $checked = DB::table('attendance')
                ->where('student_id', $s->user_id)
                ->where('created_at', '>', date_format($date_before, "Y-m-d"))
                ->where('created_at', '<', date_format($date_after, "Y-m-d"))
                ->select(['status', 'created_at'])
                ->get();
            if ($checked->count() !== 0) {
                $save_day = strtotime(date_format(date_create($checked[0]->created_at), "Y-m-d"));
                $check_day = strtotime($date_picker);
                if ($save_day == $check_day) {
                    // return student
                    array_push($data, ['user_id' => $s->user_id, 'name' => $s->name, 'status' => $checked[0]->status]);
                }
            } else {
                // return student
                // $stu = Student::where('user_id', $s->user_id)->first();
                array_push($data, ['user_id' => $s->user_id, 'name' => $s->name, 'status' => 0]);
            }
        }

        return $data;
    }

    public function postAttendance(Request $request, $date_picker)
    {
        $update = $result = 0;
        $status = $request->status;
        foreach ($status as $s) {
            $checked = DB::table('attendance')
                ->where('student_id', $s['name'])
                ->select(['created_at'])
                ->get();
            if ($checked->count() == 0) {
                $result = DB::table('attendance')->insert([
                    'student_id' => $s['name'],
                    'status' => $s['value'],
                    'created_at' => now("Asia/Ho_Chi_Minh")
                ]);
            } else {
                foreach ($checked as $c) {
                    $save_day = strtotime(date_format(date_create($c->created_at), "Y-m-d"));
                    $check_day = strtotime($date_picker);
                    if ($save_day == $check_day) {
                        $update = DB::table('attendance')
                            ->where('student_id', $s['name'])
                            ->update([
                                'status' => $s['value'],
                                'updated_at' => now("Asia/Ho_Chi_minh")
                            ]);
                        // return [$save_day, $check_day];
                    } else {
                        $result = DB::table('attendance')->insert([
                            'student_id' => $s['name'],
                            'status' => $s['value'],
                            'created_at' => now("Asia/Ho_Chi_Minh")
                        ]);
                    }
                }
            }
        }
        // return view('test', ['data' => $request->status]);
        return [intval($result), $update];
    }
}
