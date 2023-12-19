<?php


session_start();

if (!isset($_SESSION['room']) && $_SESSION['room'] != $_GET['room']) {
  header("Location: index.php");
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>En Attente</title>
  <link rel="stylesheet" href="css/style.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body class="index">
  <?php

  // ADMIN
  if (!isset($_SESSION['admin'])) {
    echo '
    <div class="roomloader">
      <h1 class="roomtitle">' . $_SESSION['player'] . '...</h1>
      <div class="loader-line"></div>
    </div>';
  } else {
    ?>
    <div class="scoreboard">
      <div class="head">
        <h1> Scoreboard </h1>
        <button class="startbtn" id="start">Start</button>
        <button class="startbtn startbtnleft" onclick="window.location.href = 'admin.php'">Retour</button>
      </div>
      <div class="scores">

      </div>
    </div>
    <a href="logout.php" class="adminbtn">Logout</a>
  <?php } ?>
  <div class="ending"></div>
</body>
<script src="js/anim.js"></script>
<?php if (isset($_SESSION['admin'])) { ?>
  <script src="js/room.js"></script>
<?php } ?>
<script>

  if (typeof (EventSource) !== "undefined") {
    <?php if (isset($_SESSION['admin'])) { ?>
      var source = new EventSource("php/roomevent.php?room=<?php echo $_GET['room']; ?>");
    <?php } else { ?>
      var source = new EventSource("php/roomevent.php?room=<?php echo $_GET['room']; ?>&user=true");
    <?php } ?>
    source.onmessage = function (event) {

      <?php if (isset($_SESSION['admin'])) { ?>
        var player = JSON.parse(event.data);


        if (player.length == 0) {
          $(".scoreboard .scores").html("Pas de joueurs...");
          return;
        }

        $(".scoreboard .scores").html("");
        for (var i = 0; i < player.length; i++) {

          $('.scoreboard .scores').append(getPlayerBody(i, player[i].LIB, player[i].SCORE));

          
          if (playersScore[i] != undefined && playersScore[i].SCORE == player[i].SCORE) {
            continue;
          }

          const scoreSound = new Audio('sfx/' + getRandomSFX());
          scoreSound.play();

        }

        playersScore = player;

      <?php } else { ?>
        var player = event.data;
        if (player === "startGame") {
          window.location.href = "game.php?room=<?php echo $_GET['room']; ?>";
        }
      <?php } ?>
    };
  } else {
    alert("Sorry, your browser does not support server-sent events...");
  }

  <?php if (isset($_SESSION['admin'])) { ?>

    $('#start').click(function () {
      fetch('php/roomevent.php?room=<?php echo $_GET['room']; ?>&start=true', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        }
      });
    })

  <?php } ?>
</script>
<script src="js/base.js"></script>

</html>