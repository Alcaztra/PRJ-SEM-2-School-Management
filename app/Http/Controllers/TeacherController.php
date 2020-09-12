<?php

namespace App\Http\Controllers;

use App\Teacher;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function getTeachers()
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
            'user_id' => 'required|max:255',
            'name' => 'required|max:255',
            'gender' => 'required',
            'email' => 'required|email',
            'phone' => 'required|regex:/^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[\s\d]*$/|max:15',
            'birthday' => 'required',
            'address' => 'required',
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
}
