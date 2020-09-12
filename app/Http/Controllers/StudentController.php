<?php

namespace App\Http\Controllers;

use App\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    public function getStudents()
    {
        return Student::all();
    }

    public function listStudents()
    {
        return view('pages.students.list-students')->with('students', $this->getStudents());
    }

    public function showFormCreateStudent()
    {
        return view('pages.students.create-student');
    }

    public function createStudent(Request $request)
    {
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
}
