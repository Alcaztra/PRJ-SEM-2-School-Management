<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function listStudents()
    {
        return view('pages.students.list-students');
    }

    public function showFormCreateStudent()
    {
        return view('pages.students.create-student');
    }
}
