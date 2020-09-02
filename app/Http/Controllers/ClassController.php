<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClassController extends Controller
{
    public function listClasses()
    {
        return view('pages.classes.list-classes');
    }

    public function showFormCreateClass()
    {
        return view('pages.classes.create-class');
    }
}
