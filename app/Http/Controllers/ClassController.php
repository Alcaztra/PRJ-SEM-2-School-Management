<?php

namespace App\Http\Controllers;

use App\_class;
use Illuminate\Http\Request;

class ClassController extends Controller
{
    public function listClasses()
    {
        $classes = _class::all();
        return view('pages.classes.list-classes')->with('classes', $classes);
    }

    public function showFormCreateClass()
    {
        return view('pages.classes.create-class');
    }

    public function createClass(Request $request)
    {
        $class = new _class();
        $class->class_id = $request->class_id;
        $class->room = $request->room;
        $class->date_start = $request->date_start;

        $class->save();

        return redirect()->intended(route('class.list'));
    }
}
