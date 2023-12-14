

let ordre = 1;

let mapTime = 0;

let timeInterval;

const idRoom = $('#room').val();

const idPlayer = $('#player').val();

const imgmap = $('#imgmap');

const timer = $('#timer');

$(document).ready(function () {
  getMap();
});


$('#pass').click(function () {
  getMap();
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
      
      //imgmap.attr('src', map.data[0].URL + '.jpg');

      mapTime = map.data[0].TIMER;
      
      ordre++;
    },
    error: function (error) {
      console
    }
  });
}

function UpdatePlayerScore(score) {
  $.ajax({
    url: 'php/gameevent.php?action=updateplayerscore&room='+idRoom,
    method: 'POST',
    data: {
      player: idPlayer,
      score: score
    },
    success: function () {
      
    }
  })
}