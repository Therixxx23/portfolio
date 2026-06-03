<?php

namespace App\Http\Controllers;

use App\Models\Education;
use App\Models\Experience;

class HomeController extends Controller
{
    public function index()
    {
        $experiences = Experience::orderBy('sort_order')->get();
        $educations = Education::orderBy('sort_order')->get();

        return view('home', compact('experiences', 'educations'));
    }
}
