
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
 
const SFX = [
    'among-us-role-reveal-sound.mp3',
    'bad-to-the-bone-meme.mp3',
    'daequan-come-here-boy-sound-effect.mp3',
    'Demoman_gibberish01.wav',
    'Demoman_gibberish02.wav',
    'Demoman_gibberish05.wav',
    'Demoman_gibberish08.wav',
    'different-variations-for-stonks-sound-effect.mp3',
    'duck-toy-sound.mp3',
    'ea-sports-meme-eeee_xHt17Ki.mp3',
    'Engineer_no01.wav',
    'fail-sound-effect.mp3',
    'gta-san-andreas-ah-shit-here-we-go-again_BWv0Gvc.mp3',
    'its-in-the-game_TyOFKRF.mp3',
    'klonk.mp3',
    'meme_lgkJmX6.mp3',
    'mission-failed-well-get-em-next-time-sound-effect-zxhixnbk.mp3',
    'movie_1_C2K5NH0.mp3',
    'obi-wan_says_hello_thereyoutubetomp4.mp3',
    'okay-meme.mp3',
    'Pootis- Sound Effect.mp3',
    'punch_u4LmMsr.mp3',
    'skill-issue-halo-announcer.mp3',
    'skull-trumpet.mp3',
    'sm64_mario_oof_jCpnBTB.mp3',
    'Spy_jeers06.wav',
    'steve-old-hurt-sound_XKZxUk4.mp3',
    'thats-a-lot-of-damage_f0qw5B7.mp3',
    'trollolo.mp3',
    'video0_yI8sAjg.mp3',
    'videoplayback_y6EZG5Z.mp3',
    'what-are-you-doing-in-my-swamp-.mp3',
    'windows-xp-startup_1ph012N.mp3',
    'woah_Wlc9EIM.mp3',
    'yt1s_nijLeKo.mp3'
]

function getRandomSFX() {
    return SFX[Math.floor(Math.random() * SFX.length)];
}

let playersScore = {}