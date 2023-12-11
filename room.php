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
    die();
  }
  ?>
  <div class="scoreboard">
    <h1 style="float: left;">Scoreboard</h1>
    <div class="scores">

    </div>
  </div>

  <div class="ending"></div>
  <script src="js/anim.js"></script>

  <?php if (isset($_SESSION['admin'])) { ?>
    <a href="logout.php" class="adminbtn">Logout</a>
  <?php } ?>
</body>
<script src="js/room.js">
  //   if (typeof (EventSource) !== "undefined") {
  //     var source = new EventSource("php/getplayers.php?room=<?php //echo $_GET['room']; ?>");
  //     source.onmessage = function (event) {
  //         var player = JSON.parse(event.data);
  //         //window.location.href = "game.php";

  //         $(".scoreboard .scores").html("");
  //         for (var i = 0; i < player.length; i++) {
  //             $(".scoreboard .scores").append("<h1>" + player[i].LIB + " : " + player[i].SCORE + "</h1>");
  //         }
  //     };
  // } else {
  //     alert("Sorry, your browser does not support server-sent events...");
  // }
</script>

</html>