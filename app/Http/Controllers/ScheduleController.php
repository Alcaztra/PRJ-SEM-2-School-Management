<?php

namespace App\Http\Controllers;

use App\Teacher;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index()
    {
        return view('pages.calendar');
    }
}
