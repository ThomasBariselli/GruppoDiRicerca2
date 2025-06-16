<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Models\User;

class RegisteredUserController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function store()
    {
        $validatedAttributes = request()->validate([
            'first-name'        => ['required'],
            'last-name'         => ['required'],
            'email'             => ['required' , 'email' , 'max:254'],
            'password'          => ['required' , 'confirmed']
        ]);

        $email = request()->validate([
            'email' => ['required' , 'email']
        ]);

        $exists = User::where('email', $email)->exists();

        if($exists){

            throw ValidationException::withMessages([
                'email' => 'Questo utente è già presente'
            ]);
        }

        $user = User::create($validatedAttributes);

        Auth::login($user);

        request()->session()->regenerate();

        return redirect('/');
    }
}