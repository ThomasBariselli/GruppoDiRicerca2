<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\Models\Publication;
use App\Models\User;

class PubbController extends Controller
{
    public function index(){
        $publications = Publication::all();
        return view('pubblicazioni.index', compact('pubblicazioni'));
    }

    public function create(){
        return view('pubblicazioni.create');
    }
    public function store(Request $request){

        $validated = $request->validate(['title' => ['required','min:3'],'description' => ['min:3'],'doi' => ['required','min:15'],'inbook' => ['min:3']]);

        $doi = request()->validate([
            'doi' => ['required','min:15']
        ]);

        $exists = Publication::where('doi', $doi)->exists();

        if($exists){

            throw ValidationException::withMessages([
                'doi' => 'Questo doi è già presente'
            ]);
        }
        Publication::create($validated);
        return to_route('pubblicazioni.index');
    }

    public function edit(Publication $publication){
        $members=User::all();
        return view('pubblicazioni.edit', compact('publication','members'));
    }
    public function update(Request $request,Publication $publication){

        $validated = $request->validate(['title' => ['required','min:3'],'description' => ['required','min:3'],'doi' => ['required','min:15']]);

        $publication->update($validated);

        return to_route('pubblicazioni.index');
    }
    public function destroy(Publication $publication){

        $publication->delete();

        return back()->with('message','Course destroyed');
    }
    public function assignMember(Request $request, Publication $publication){

        if ($publication->users->contains($request->member)){
            return back()->with('message','Course already assigned');
        }
        $publication->users()->attach($request->member);
        return back()->with('message','Course assigned');
    }
    public function revokeMember(Publication $publication, User $member){

        if ($publication->users->contains($member->id)){
            $publication->users()->detach($member->id);
            return back()->with('message','Course removed');
        }
        return back()->with('message','Course not exists');
    }
}
