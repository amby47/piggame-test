<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function create() {
        return view('game.create');
    }

    public function play() {
        return view('game.play');
    }

    public function store(Request $request) {
        $game = new Game();
        $game->winner = $request->winner;
        $game->save();
        return 'saved';
    }
}
