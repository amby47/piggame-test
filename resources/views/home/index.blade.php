@extends('layouts.main')

@section('content')

    <div class="container">
        <div class="center-container">
            <div class="game-container">
                <div class="header text-center">
                    <h1>The Pig Game</h1>
                </div>
                <div class="dice-image text-center">
                    <img src="/images/dice.png" height="200" width="200" alt="">
                </div>
                    <div class="hall-of-fame">
                        <h2 class="text-center">Hall of Fame</h2>
                        <ul class="hall-of-fame-list">
                            @foreach ($games as $game)
                            <li>{{$game->winner}}</li>
                            @endforeach
                        </ul>
                    </div>

                <div class="buttons text-center">
                    <a href="{{route('create-game')}}" class="btn btn-success">Start Game</a>

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
    padding: 3rem;
    width: 50%;
    margin-left: 25%;
}
.hall-of-fame-list li {
    display: inline-block;
    margin-left: 20px;
    background-color: #f39c12;
    font-weight: bold;
    padding: 5px;
    margin-top: 10px;
}
@endsection


@section('js')
@endsection
