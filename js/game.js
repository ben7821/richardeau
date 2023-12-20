

let ordre = 1;

let mapTime = 0;

let timeInterval;

const MAXPOINT = 20;

const idRoom = $('#room').val();

const idPlayer = $('#player').val();

const imgmap = $('#imgmap');

const timer = $('#timer');

$(document).ready(function () {
  clearInterval(timeInterval);
  getMap();
  // $('.ending').removeClass('ending-force'); 
  UpdatePlayerScore(0);
});


$('#pass').click(function () {
  clearInterval(timeInterval);
  getMap();
  UpdatePlayerScore(0);
});

$('#next').click(function () {
  clearInterval(timeInterval);
  getMap();
  if (mapTime <= 0) {
    UpdatePlayerScore(0);
    return;
  } 
  let score = MAXPOINT - Math.floor(mapTime / 60);
  UpdatePlayerScore(score);
});

function getMap() {
  $.ajax({
    url: 'php/gameevent.php?action=getmap&room=' + idRoom,
    method: 'POST',
    data: {
      order: ordre
    },
    success: function (data) {
      const map = JSON.parse(data);

      if (map.data[0].URL == undefined) {
        window.location.href = 'endgame.php?room=' + idRoom;
        return;
      }
      imgmap.attr('src', map.data[0].URL + '.jpg');

      if (document.querySelector('#guess')) {
        document.querySelector('#guess').remove();
      }

      setTimeout(function () {
        // si le tableau RICHARDEAU[0] est vide on fait pas NewGuess
        if (Object.keys(map.data[0].RICHARDEAU).length > 0) {
          NewGuess(map.data[0].RICHARDEAU);
        }
      }, 100);

      $('#next').prop('disabled', true);
      $('#next').css({ backgroundColor: '#ff000055' });

      
      // mapTime = map.data[0].TIMER;
      mapTime = 20;
      updateTimer();
      
      timeInterval = setInterval(function () {
        if (mapTime > 0) {
          mapTime--;
          
          updateTimer();
        }
      }, 1000);
      
      ordre++;
    },
    error: function (error) {
      console.log(error);
    }
  });
  
  setTimeout(function () {
    FadeOut();
  }, 500);
}


function UpdatePlayerScore(score) {
  $.ajax({
    url: 'php/gameevent.php?action=updateplayerscore&room=' + idRoom,
    method: 'POST',
    data: {
      player: idPlayer,
      score: score
    },
    success: function () {

    }
  })
}

function updateTimer() {
  const min = Math.floor(mapTime / 60);
  const sec = mapTime % 60;

  const format = (min < 10 ? '0' + min : min) + ':' + (sec < 10 ? '0' + sec : sec);
  timer.text(format);
}

function NewGuess(data) {
  const imgmapx = $('#imgmap').width();
  const imgmapy = $('#imgmap').height();

  const img = document.createElement('img');
  img.src = data.URL;
  img.id = 'guess';

  let size = data.TAILLE.split(',').map(x => parseInt(x));

  img.width = size[0] / 100 * imgmapx;
  img.height = size[1] / 100 * imgmapy;

  let pos = data.POSITION.split(',').map(x => parseInt(x));
  const offset = $('#imgmap').offset();

  img.dataset.pos = pos.join(',');

  $(img).css({
    position: 'absolute',
    top: offset.top + pos[0] / 100 * imgmapx,
    left: offset.left + pos[1] / 100 * imgmapy,
    zIndex: 99,
    filter: 'opacity(0.5)'
  });

  $(img).data('xpos', pos[0]);
  $(img).data('ypos', pos[1]);

  // add img to body
  document.body.appendChild(img);

  $(img).click(function (e) {
    $(this).remove();
    $('#next').prop('disabled', false);
    $('#next').css({ backgroundColor: '#00ff0055' });
  })
}


function onOrientationChange(event) {
  if (window.innerHeight > window.innerWidth) {
    $('#imgmap').css({ width: '100%', height: 'auto' });
  } else {
    $('#imgmap').css({ width: 'auto', height: '100%' });
  }
}

// window.addEventListener('load', onOrientationChange);
// window.addEventListener('orientationchange', onOrientationChange);

$(window).resize(function () {
  const imgmapx = $('#imgmap').width();
  const imgmapy = $('#imgmap').height();

  const img = document.querySelector('#guess');

  if (img) {
    let pos = img.dataset.pos.split(',').map(x => parseInt(x));
    const offset = $('#imgmap').offset();

    // Adjust the position here based on your requirements
    $(img).css({
      top: offset.top + $(img).data('xpos') / 100 * imgmapx,
      left: offset.left + $(img).data('ypos') / 100 * imgmapy,
    });
  }
});

function FadeIn() {
  $('.ending').addClass('.ending-animate');
}

function FadeOut() {
  $('.ending').removeClass('.ending-animate');
}