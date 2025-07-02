<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class MemberController extends Controller
{
    use AuthorizesRequests;

    public function index(){
        $members = User::all();
        return view('chisiamo.index', compact('members'));
    }

    public function create(){
        return view('chisiamo.create');
    }
    public function store(Request $request){

        $validated = $request->validate(['firstname' => ['required','min:3'],'lastname' => ['required','min:3'],'email' => ['required','min:3']]);
        User::create($validated);
        return to_route('chisiamo.index');
    }

    public function edit(User $member){
        
    if (Auth::id() != $member->id) {
        abort(403, 'Accesso non autorizzato');
    }

        $courses=Course::all();
        return view('chisiamo.edit', compact('member','courses'));
    }
    public function update(Request $request,User $member){
        
        if (Auth::id() != $member->id) {
            abort(403, 'Accesso non autorizzato');
        }

        $validated = $request->validate(['firstname' => ['required','min:3'],'lastname' => ['required','min:3'],'email' => ['required','min:3']]);
        $member->update($validated);

        return to_route('chisiamo.index');
    }
    public function destroy(User $member){

        $member->delete();

        return back()->with('message','Member destroyed');
    }
    public function assignCourse(Request $request, User $member){

        if ($member->courses->contains($request->course)){
            return back()->with('message','Course already assigned');
        }

        $member->courses()->attach($request->course);
        return back()->with('message','Course assigned');
    }
    public function revokeCourse(User $member, Course $course){

        if ($member->courses->contains($course->id)){
            $member->courses()->detach($course->id);
            return back()->with('message','Course removed');
        }
        return back()->with('message','Course not exists');
    }
}
