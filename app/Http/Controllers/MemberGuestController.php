<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class MemberGuestController extends Controller
{
    public function index(){
        $members = User::all();
        return view('chisiamo.index', compact('members'));
    }
}
