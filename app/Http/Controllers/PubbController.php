<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;
use App\Models\Publication;
use App\Models\User;

class PubbController extends Controller
{
    public function index(){
        $pubblicazioni = Publication::all();
        return view('pubblicazioni.index', compact('pubblicazioni'));
    }

    public function create(){
        return view('pubblicazioni.create');
    }
    public function store(Request $request){

        $validated = $request->validate(['title' => ['required','min:3'],'description' => ['min:3'],'doi' => ['required','min:15'],'leaderemail' => ['min:3','required'],'inbook' => ['min:3']]);

        $doi = request()->validate([
            'doi' => ['required','min:15']
        ]);

        $leadermail = request()->validate([
            'leaderemail' => ['required','min:3']
        ]);

        $exists = Publication::where('doi', $doi)->exists();
        $existsEmail = User::where('email', $leadermail)->exists();

        if($exists){

            throw ValidationException::withMessages([
                'doi' => 'Questo doi è già presente'
            ]);
        }
        if(!$existsEmail){

            throw ValidationException::withMessages([
                'leaderemail' => 'Questo utente non esiste'
            ]);
        }
        Publication::create($validated);
        return to_route('pubblicazioni.index');
    }

    public function edit(Publication $publication){
        if (Auth::user()->email != $publication->leaderemail && !$publication->users->contains(Auth::id())) {
            abort(403, 'Accesso non autorizzato');
        }
        $members=User::all();
        return view('pubblicazioni.edit', compact('publication','members'));
    }
    public function update(Request $request,Publication $publication){

        if (Auth::user()->email != $publication->leaderemail && !$publication->users->contains(Auth::id())) {
            abort(403, 'Accesso non autorizzato');
        }
        $validated = $request->validate(['title' => ['required','min:3'],'description' => ['required','min:3'],'doi' => ['required','min:15']]);

        $publication->update($validated);

        return to_route('pubblicazioni.index');
    }
    public function destroy(Publication $publication){

        if (Auth::user()->email != $publication->leaderemail && !$publication->users->contains(Auth::id())) {
            abort(403, 'Accesso non autorizzato');
        }
        $publication->delete();

        return back()->with('message','Course destroyed');
    }
    public function assignMember(Request $request, Publication $publication){

        if (Auth::user()->email != $publication->leaderemail && !$publication->users->contains(Auth::id())) {
            abort(403, 'Accesso non autorizzato');
        }
        if ($publication->users->contains($request->member)){
            return back()->with('message','Course already assigned');
        }
        $publication->users()->attach($request->member);
        return back()->with('message','Course assigned');
    }
    public function revokeMember(Publication $publication, User $member){

        if (Auth::user()->email != $publication->leaderemail && !$publication->users->contains(Auth::id())) {
            abort(403, 'Accesso non autorizzato');
        }
        if ($publication->users->contains($member->id)){
            $publication->users()->detach($member->id);
            return back()->with('message','Course removed');
        }
        return back()->with('message','Course not exists');
    }
}
