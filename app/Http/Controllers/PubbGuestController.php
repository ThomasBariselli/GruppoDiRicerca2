<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Publication;

class PubbGuestController extends Controller
{
    public function index(){
        $pubblicazioni = Publication::all();
        return view('pubblicazioni.index', compact('pubblicazioni'));
    }
}
