<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\User;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;

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

        $validated = $request->validate(['name' => ['required','min:3'],'description' => ['required','min:3'],'leaderemail' => ['min:3','required']]);
        
        $name = request()->validate([
            'name' => ['required','min:3']
        ]);

        $leadermail = request()->validate([
            'leaderemail' => ['required','min:3']
        ]);
        $existsName = Course::where('name', $name)->exists();
        $existsEmail = User::where('email', $leadermail)->exists();

        if($existsName){

            throw ValidationException::withMessages([
                'title' => 'Questo progetto è già presente'
            ]);
        }
        if(!$existsEmail){

            throw ValidationException::withMessages([
                'leaderemail' => 'Questo utente non esiste'
            ]);
        }
        
        Course::create($validated);
        return to_route('corsi.index');
    }

    public function edit(Course $course){
        if (Auth::user()->email != $course->leaderemail && !$course->users->contains(Auth::id())) {
            abort(403, 'Accesso non autorizzato');
        }
        $members=User::all();
        return view('corsi.edit', compact('course','members'));
    }
    public function update(Request $request,Course $course){
        if (Auth::user()->email != $course->leaderemail && !$course->users->contains(Auth::id())) {
            abort(403, 'Accesso non autorizzato');
        }
        $validated = $request->validate(['name' => ['required','min:3'],'description' => ['required','min:3']]);
        $course->update($validated);

        return to_route('corsi.index');
    }
    public function destroy(Course $course){
        if (Auth::user()->email != $course->leaderemail && !$course->users->contains(Auth::id())) {
            abort(403, 'Accesso non autorizzato');
        }
        $course->delete();

        return back()->with('message','Course destroyed');
    }
    public function assignMember(Request $request, Course $course){
        if (Auth::user()->email != $course->leaderemail && !$course->users->contains(Auth::id())) {
            abort(403, 'Accesso non autorizzato');
        }
        if ($course->users->contains($request->member)){
            return back()->with('message','Course already assigned');
        }
        $course->users()->attach($request->member);
        return back()->with('message','Course assigned');
    }
    public function revokeMember(Course $course, User $member){
        if (Auth::user()->email != $course->leaderemail && !$course->users->contains(Auth::id())) {
            abort(403, 'Accesso non autorizzato');
        }
        if ($course->users->contains($member->id)){
            $course->users()->detach($member->id);
            return back()->with('message','Course removed');
        }
        return back()->with('message','Course not exists');
    }
}
