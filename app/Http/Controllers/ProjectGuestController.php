<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

class ProjectGuestController extends Controller
{
    public function index(){
        $projects = Project::all();
        return view('progetti.index', compact('projects'));
    }
}
