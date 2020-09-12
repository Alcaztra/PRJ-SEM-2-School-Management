<?php

namespace App\Http\Controllers;

use App\Course;
use App\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function getSubjects()
    {
        return Subject::all();
    }
    public function listSubjects()
    {

        return view('pages.subjects.list-subjects')->with('subjects', $this->getSubjects());
    }

    public function showFormCreateSubject()
    {
        return view('pages.subjects.create-subject');
    }

    public function createSubject(Request $request)
    {
        $validatedData = $request->validate([
            'subject_id' => 'required|unique:subjects,subject_id|max:255',
            'name' => 'required',
        ]);
        $subject = new Subject();
        $subject->subject_id = $request->subject_id;
        $subject->name = $request->name;
        $subject->NoS = $request->NoS;
        $subject->duration = $request->NoS * 2;

        $subject->save();

        return redirect(route('subject.list'));
    }
}
