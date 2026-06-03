<?php

namespace App\Http\Controllers;

use App\Models\Game;

class PlayController extends Controller
{
    public function index()
    {
        $games = Game::orderBy('sort_order')->get();

        return view('play', compact('games'));
    }
}
