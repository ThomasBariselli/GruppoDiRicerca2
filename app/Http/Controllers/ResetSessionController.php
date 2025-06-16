<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Mail;
use App\Models\User;

class ResetSessionController extends Controller
{
    public function create()
    {

    }

    public function store()
    {
        $email = request()->validate([
            'email' => ['required' , 'email']
        ]);

        $exists = User::where('email', $email)->exists();

        if(!$exists){

            throw ValidationException::withMessages([
                'email' => 'Questa email non è presente'
            ]);
        }
        
        Mail::to($email)->send(
            new \App\Mail\ResetPassword()
        );

        request()->session()->regenerate();

        return redirect('/');
    }

    public function destroy()
    {
        Auth::logout();

        return redirect('/');
    }
}
