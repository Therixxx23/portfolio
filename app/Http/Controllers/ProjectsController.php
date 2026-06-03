<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectsController extends Controller
{
    public function index()
    {
        $projects = Project::orderBy('sort_order')->get();
        $success = session()->get('success');

        return view('projects', compact('projects', 'success'));
    }
}
