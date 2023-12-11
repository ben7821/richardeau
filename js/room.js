function getPlayerBody(pos, name, score) {
    switch (pos) {
        case 0:
            pos = "or";
            break;
        case 1:
            pos = "silver";
            break;
        case 2:
            pos = "bronze";
            break;
        case pos % 2 == 0:
            pos = "p1";
            break;
        case pos % 2 == 1:
            pos = "p2";
            break;
        default:
            pos = "p1";
            break;
    }

    return `
    <div class="player ${pos}">
        <h3 class="player_score">${score}</h3>
        <h3 class="player_name">${name}</h3>
    </div>`;
}