<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseGuestController extends Controller
{
    public function index(){
        $courses = Course::all();
        return view('corsi.index', compact('courses'));
    }
}
