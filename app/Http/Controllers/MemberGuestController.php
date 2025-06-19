<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;

class MemberGuestController extends Controller
{
    public function index(){
        $members = Member::all();
        return view('chisiamo.index', compact('members'));
    }
}
