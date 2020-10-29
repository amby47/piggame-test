@extends('layouts.main')

@section('content')

<div class="container">
    <div class="center-container">
        <div class="game-container">
            <div class="header text-center">
                <h1>On-going Game</h1>
                <h3 id="winner-text"></h3>
                <a id="back-to-home-btn" style="display: none;" href="/" class="btn btn-primary mt-4">Back to home</a>
            </div>
            <div class="game">
                <div class="dice-display text-center pt-5 pb-5">
                    <img id="dice-display" src="/images/dices/dice-6.png" alt="">
                </div>

                <div class="buttons text-center">
                    <button onclick="roll()" class="btn btn-primary">Roll the dice</button>
                    <button onclick="hold()" class="btn btn-info">Hold</button>
                </div>
            </div>
        </div>

        <div class="game-container mt-2">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <td> <strong>Player</strong> </td>
                        <td> <strong>Overall Score</strong></td>
                        <td><strong>Round Score</strong></td>
                        <td><strong>Progress</strong></td>
                    </tr>
                </thead>

                <tbody id="player-list">
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection


@section('css')
.game-container {
    background-color: white;
    padding: 2rem;
    border-radius: 10px;
}
.center-container {
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

.active-player {
    border: 3px solid #9e9e9e;
    background-color: #e8e8e8;
}
@endsection


@section('js')
var urlParams = new URLSearchParams(window.location.search);
var players = [urlParams.get('p1'), urlParams.get('p2')]
var state = {
    'currentPlayer': 0,
    'round': {
        'roll': 0,
    },
    'scores': {
        0: {'overall': 0, 'roundscore': 0, 'progress': 0},
        1: {'overall': 0, 'roundscore': 0, 'progress': 0}
    },
    winner: -1
}

initialisePlayersTable();

function initialisePlayersTable() {
    for (let i = 0; i < players.length; i++) {
        var player = players[i];
        $('#player-list').append('<tr><td>'+ player +'</td><td>0</td><td>0</td><td>0</td></tr>')
    }
    updateActivePlayerDisplay();
}

function updateActivePlayerDisplay() {
    var elements = $('#player-list').children();
    for (let i = 0; i < elements.length; i++) {
        try{
            var el = elements[i];
            el.classList.remove('active-player');
        }
        catch {
            //
        }
    }
    var activePlayerElement = $('#player-list').children()[state.currentPlayer];
    activePlayerElement.classList.add('active-player');
}

function roll() {
    if (state.winner == -1) {
        var result = Math.floor((Math.random() * 6) + 1); // Generates random number between 1-6
        // Update the result on display
        updateDiceDisplay(result);
        // Update scores
        updateScores(result);

        if (result === 1) {
            clearCurrentRoundScore();
        }
    }

}

function clearCurrentRoundScore() {
    state.scores[state.currentPlayer].roundscore = 0;
    updateScoreDisplay();
    nextPlayer();
}

function updateScores(currentRoll) {
    // Update round score
    state.scores[state.currentPlayer].roundscore += currentRoll;
    if (state.scores[state.currentPlayer].roundscore >= 100) {

        declareCurrentWinner();
    }
    updateScoreDisplay();
}

function declareCurrentWinner() {
    state.winner = state.currentPlayer;
    $('#winner-text').text(players[state.currentPlayer] + ' is the Winner')
    $('#back-to-home-btn').css('display', 'inline');
    $.post('/game/end',
    {
        '_token': '{{ Session::token() }}',
        winner: players[state.winner]
    }).success(() => {
        console.log('upload successful');
    })
}

function hold() {
    if (state.winner === -1) {
        // Reset round score & add it to overall score
        state.scores[state.currentPlayer].overall += state.scores[state.currentPlayer].roundscore;
        state.scores[state.currentPlayer].roundscore = 0;
        state.scores[state.currentPlayer].progress = (state.scores[state.currentPlayer].overall)
        if (state.scores[state.currentPlayer].overall >= 100) {
            declareCurrentWinner();
            return;
        }
        updateScoreDisplay();
        nextPlayer();
    }
}

function nextPlayer() {
    if (state.currentPlayer == 0) {
        state.currentPlayer = 1;
    } else {
        state.currentPlayer = 0;
    }
    updateActivePlayerDisplay();
}

function updateScoreDisplay() {
    var el = $('#player-list').children()[state.currentPlayer];
    var tblEls = el.children;
    // Update overall score display
    tblEls[1].innerHTML = state.scores[state.currentPlayer].overall;
    tblEls[2].innerHTML = state.scores[state.currentPlayer].roundscore;
    tblEls[3].innerHTML = state.scores[state.currentPlayer].progress;
}

function updateDiceDisplay(number) {
    var dices = {
        '1': '/images/dices/dice-1.png',
        '2': '/images/dices/dice-2.png',
        '3': '/images/dices/dice-3.png',
        '4': '/images/dices/dice-4.png',
        '5': '/images/dices/dice-5.png',
        '6': '/images/dices/dice-6.png',
    }
    $('#dice-display').attr('src', dices[number.toString()]);
}

@endsection
