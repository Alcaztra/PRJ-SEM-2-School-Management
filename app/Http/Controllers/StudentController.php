<?php

namespace App\Http\Controllers;

use App\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function listStudents()
    {
        $students = Student::all();
        return view('pages.students.list-students')->with('students', $students);
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
}
