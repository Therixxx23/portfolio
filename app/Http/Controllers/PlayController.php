<?php

namespace App\Http\Controllers;

use App\Models\Game;

class PlayController extends Controller
{
    public function index()
    {
        $games = Game::where('status', 'published')->orderBy('sort_order')->get();
        return view('play', compact('games'));
    }

    public function show(Game $game)
    {
        if ($game->status !== 'published') {
            abort(404);
        }
        return view('play-show', compact('game'));
    }
}
