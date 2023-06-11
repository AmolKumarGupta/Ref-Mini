<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HabitTrackerController extends Controller
{
    public function index()
    {
        return view('habit-tracker.index');
    }
}
