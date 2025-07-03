<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\Models\Project;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    public function index(){
        $projects = Project::all();
        return view('progetti.index', compact('projects'));
    }

    public function create(){
        $members=User::all();
        return view('progetti.create',compact('members'));
    }
    public function store(Request $request){

        $validated = $request->validate(['title' => ['required','min:3'],'description' => ['min:3'],'status' => ['min:3'],'leaderemail' => ['min:3','required']]);

        $title = request()->validate([
            'title' => ['required','min:3']
        ]);

        $leadermail = request()->validate([
            'leaderemail' => ['required','min:3']
        ]);
        $existsTitle = Project::where('title', $title)->exists();
        $existsEmail = User::where('email', $leadermail)->exists();

        if($existsTitle){

            throw ValidationException::withMessages([
                'title' => 'Questo progetto è già presente'
            ]);
        }
        if(!$existsEmail){

            throw ValidationException::withMessages([
                'leaderemail' => 'Questo utente non esiste'
            ]);
        }
        Project::create($validated);
        return to_route('progetti.index');
    }

    public function edit(Project $project){
            if (Auth::user()->email != $project->leaderemail) {
            abort(403, 'Accesso non autorizzato');
        }
        $members=User::all();
        return view('progetti.edit', compact('project','members'));
    }
    public function update(Request $request,Project $project){
        if (Auth::user()->email != $project->leaderemail) {
            abort(403, 'Accesso non autorizzato');
        }
        $validated = $request->validate(['title' => ['required','min:3'],'description' => ['required','min:3'],'status' => ['required']]);

        $project->update($validated);

        return to_route('progetti.index');
    }
    public function destroy(Project $project){
        if (Auth::user()->email != $project->leaderemail) {
            abort(403, 'Accesso non autorizzato');
        }
        $project->delete();

        return back()->with('message','Course destroyed');
    }
    public function assignMember(Request $request, Project $project){
        if (Auth::user()->email != $project->leaderemail) {
            abort(403, 'Accesso non autorizzato');
        }
        if ($project->users->contains($request->member)){
            return back()->with('message','Course already assigned');
        }
        $project->users()->attach($request->member);
        return back()->with('message','Course assigned');
    }
    public function revokeMember(Project $project, User $member){
        if (Auth::user()->email != $project->leaderemail) {
            abort(403, 'Accesso non autorizzato');
        }
        if ($project->users->contains($member->id)){
            $project->users()->detach($member->id);
            return back()->with('message','Course removed');
        }
        return back()->with('message','Course not exists');
    }
}
