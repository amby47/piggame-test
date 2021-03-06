<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        $games = Game::all();
        return view('home.index', compact('games'));
    }
}
