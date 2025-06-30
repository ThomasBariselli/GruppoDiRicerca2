<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\Models\Project;
use App\Models\User;

class ProjectController extends Controller
{
    public function index(){
        $projects = Project::all();
        return view('progetti.index', compact('projects'));
    }

    public function create(){
        return view('progetti.create');
    }
    public function store(Request $request){

        $validated = $request->validate(['title' => ['required','min:3'],'description' => ['min:3'],'status' => ['min:3']]);

        $title = request()->validate([
            'title' => ['required','min:3']
        ]);

        $exists = Project::where('title', $title)->exists();

        if($exists){

            throw ValidationException::withMessages([
                'title' => 'Questo progetto è già presente'
            ]);
        }
        Project::create($validated);
        return to_route('progetti.index');
    }

    public function edit(Project $project){
        $members=User::all();
        return view('progetti.edit', compact('project','members'));
    }
    public function update(Request $request,Project $project){

        $validated = $request->validate(['title' => ['required','min:3'],'description' => ['required','min:3'],'status' => ['required']]);

        $project->update($validated);

        return to_route('progetti.index');
    }
    public function destroy(Project $project){

        $project->delete();

        return back()->with('message','Course destroyed');
    }
    public function assignMember(Request $request, Project $project){

        if ($project->users->contains($request->member)){
            return back()->with('message','Course already assigned');
        }
        $project->users()->attach($request->member);
        return back()->with('message','Course assigned');
    }
    public function revokeMember(Project $project, User $member){

        if ($project->users->contains($member->id)){
            $project->users()->detach($member->id);
            return back()->with('message','Course removed');
        }
        return back()->with('message','Course not exists');
    }
}
