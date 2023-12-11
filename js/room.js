function getPlayerBody(pos, name, score) {
    return `
    <div class="player ${pos}">
        <h3 class="player_score">${score}</h3>
        <h3 class="player_name">${name}</h3>
    </div>`;
}

$(document).ready(function () {
    $('.scores').append(getPlayerBody('or', 'Player 1', 0));
    $('.scores').append(getPlayerBody('silver', 'Player 2', 0));
    $('.scores').append(getPlayerBody('bronze', 'Player 3', 0));
    $('.scores').append(getPlayerBody('p1', 'Player 4', 0));
    $('.scores').append(getPlayerBody('p2', 'Player 5', 0));
    $('.scores').append(getPlayerBody('p1', 'Player 6', 0));
    $('.scores').append(getPlayerBody('p2', 'Player 7', 0));
    $('.scores').append(getPlayerBody('p1', 'Player 8', 0));
    $('.scores').append(getPlayerBody('p2', 'Player 9', 0));
    $('.scores').append(getPlayerBody('p1', 'Player 10', 0));
});