<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function listTeachers()
    {
        return view('pages.teachers.list-teachers');
    }

    public function showFormCreateTeacher()
    {
        return view('pages.teachers.create-teacher');
    }
}
