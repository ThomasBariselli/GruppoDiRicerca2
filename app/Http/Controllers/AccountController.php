<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Models\User;

class AccountController extends Controller
{
    public function update(User $user)
    {
        $validatedAttributes = request()->validate([
            'firstname'        => ['required'],
            'lastname'         => ['required'],
            'email'             => ['required' , 'email' , 'max:254']
        ]);

        $email = request()->validate([
            'email' => ['required' , 'email']
        ]);

        $user->update($validatedAttributes);

        request()->session()->regenerate();

        return redirect('/');
    }
}