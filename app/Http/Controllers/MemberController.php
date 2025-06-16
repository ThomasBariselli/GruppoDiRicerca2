<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\Course;

class MemberController extends Controller
{
    public function index(){
        $members = Member::all();
        return view('chisiamo.index', compact('members'));
    }

    public function create(){
        return view('chisiamo.create');
    }
    public function store(Request $request){

        $validated = $request->validate(['name' => ['required','min:3'],'surname' => ['required','min:3'],'role' => ['required','min:3'],'description' => ['required','min:3']]);
        Member::create($validated);
        return to_route('chisiamo.index');
    }

    public function edit(Member $member){
        $courses=Course::all();
        return view('chisiamo.edit', compact('member','courses'));
    }
    public function update(Request $request,Member $member){

        $validated = $request->validate(['name' => ['required','min:3'],'surname' => ['required','min:3'],'role' => ['required','min:3'],'description' => ['required','min:3']]);
        $member->update($validated);

        return to_route('chisiamo.index');
    }
    public function destroy(Member $member){

        $member->delete();

        return back()->with('message','Member destroyed');
    }
    public function assignCourse(Request $request, Member $member){

        /*if ($member->courses->contains($request->course->id)){
            return back()->with('message','Course already assigned');
        }*/
        $member->courses()->attach($request->input('course_id'));
        return back()->with('message','Course assigned');
    }
    public function revokeCourse(Member $member, Course $course){

        if ($member->courses()->contains($course->id)){
            $member->courses()->detach($course->id);
            return back()->with('message','Course removed');
        }
        return back()->with('message','Course not exists');
    }
}
