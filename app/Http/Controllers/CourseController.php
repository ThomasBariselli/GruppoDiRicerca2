<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\User;

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
        $members=User::all();
        return view('corsi.edit', compact('course','members'));
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
    public function assignMember(Request $request, Course $course){

        if ($course->users->contains($request->member)){
            return back()->with('message','Course already assigned');
        }
        $course->users()->attach($request->member);
        return back()->with('message','Course assigned');
    }
    public function revokeMember(Course $course, User $member){

        if ($course->users->contains($member->id)){
            $course->users()->detach($member->id);
            return back()->with('message','Course removed');
        }
        return back()->with('message','Course not exists');
    }
}
