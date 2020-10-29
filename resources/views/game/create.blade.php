@extends('layouts.main')

@section('content')

<div class="container">
    <div class="center-container">
        <div class="game-container">
            <div class="header text-center">
                <h1>Start a game</h1>
            </div>
            <div class="players">
                <h3>Add Players</h3>
                <div class="form-group">
                    <label>Player 1 Name</label>
                    <input id="player-1-name" type="name" class="form-control" id="player-name">
                </div>
                <div class="form-group">
                    <label>Player 2 Name</label>
                    <input id="player-2-name" type="name" class="form-control" id="player-name">
                </div>
            </div>

            <div class="text-right mt-3">
                <button onclick="startGame()" class="btn btn-success">Start Game</button>
            </div>
        </div>

    </div>

</div>

@endsection


@section('css')
.game-container {
background-color: white;
padding: 2rem;
border-radius: 10px;
position: absolute;
left: 50%;
top: 50%;
-webkit-transform: translate(-50%, -50%);
transform: translate(-50%, -50%);
width: 50%;
}
.hall-of-fame {
padding: 5rem;
}
@endsection


@section('js')
function startGame() {
    var p1Name = $('#player-1-name').val();
    var p2Name = $('#player-2-name').val();
    window.location = '/game/play?p1=' + p1Name + '&p2=' + p2Name;
}
@endsection
