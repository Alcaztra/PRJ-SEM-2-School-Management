<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserProfile;
use App\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    public function getStudents()
    {
        return Student::all();
    }

    public function getFreeStudents()
    {
        return Student::where('class_id', null)->orWhere('class_id', '')->get();
    }

    public function listStudents()
    {
        return view('pages.students.list-students')->with('students', $this->getStudents());
    }

    public function showFormCreateStudent()
    {
        return view('pages.students.create-student');
    }

    public function createStudent(UserProfile $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'bail|required|regex:/[a-zA-Z0-9]*/|unique:students,user_id|max:50',
        ]);
        $student = new Student();
        $student->user_id = $request->user_id;
        $student->name = $request->name;
        $student->avatar = $request->avatar;
        $student->gender = $request->gender;
        $student->email = $request->email;
        $student->phone = $request->phone;
        $student->birthday = $request->birthday;
        $student->address = $request->address;

        $student->save();
        return redirect()->intended(route('student.list'));
    }

    public function showStudentDetails($student_id)
    {
        $student = Student::where('user_id', $student_id)->first();
        return view('pages.students.student-details')->with('student', $student);
    }

    public function resetPassword($student_id)
    {
        $student = Student::where('user_id', $student_id)
            ->first();
        $student->password = Hash::make('password');
        $student->save();
        $result = Hash::check('password', Student::find($student)->first()->password);

        return back()->with('result', $result);
    }

    public function enroll(Request $request)
    {
        $user = Auth::guard('student')->user();
        $subject_id = $request->subject_id;
        $class_id = $request->class_id;
        if (strcmp($user->class_id, $class_id) == 0) {
            if (strcmp($request->key_enroll, ($class_id . '_' . $subject_id)) == 0) {
                $result =  DB::table('enrollment')->insert(['class_id' => $class_id, 'subject_id' => $subject_id, 'student_id' => $user->user_id, 'created_at' => now("Asia/Ho_Chi_Minh")]);
                return intval($result);
            }
        }
        return $request;
    }
}
