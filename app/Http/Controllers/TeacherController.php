<?php

namespace App\Http\Controllers;

use App\Teacher;
use Illuminate\Http\Request;
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
}
