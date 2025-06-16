<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;

class CourseController extends Controller
{
    public function index(){
        $courses = Course::all();
        return view('corsi.index', compact('courses'));
    }

    public function create(){
        return view('corsi.create');
    }
    public function store(Request $request){

        $validated = $request->validate(['name' => ['required','min:3'],'description' => ['required','min:3']]);
        Course::create($validated);
        return to_route('corsi.index');
    }

    public function edit(Course $course){
        return view('corsi.edit', compact('course'));
    }
    public function update(Request $request,Course $course){

        $validated = $request->validate(['name' => ['required','min:3'],'description' => ['required','min:3']]);
        $course->update($validated);

        return to_route('corsi.index');
    }
    public function destroy(Course $course){

        $course->delete();

        return back()->with('message','Course destroyed');
    }
}
