<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function listSubjects()
    {
        return view('pages.subjects.list-subjects');
    }

    public function showFormCreateSubject()
    {
        return view('pages.subjects.create-subject');
    }
}
