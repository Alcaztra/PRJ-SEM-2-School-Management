<?php

namespace App\Http\Controllers;

use App\Course;
use App\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function listSubjects()
    {
        $subjects = Subject::all();
        return view('pages.subjects.list-subjects')->with('subjects', $subjects);
    }

    public function showFormCreateSubject()
    {
        return view('pages.subjects.create-subject');
    }

    public function createSubject(Request $request)
    {
        $subject = new Subject();
        $subject->subject_id = $request->subject_id;
        $subject->name = $request->name;
        $subject->NoS = $request->NoS;

        $subject->save();

        return redirect()->intended(route('subject.list'));
    }
}
