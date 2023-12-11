<?php

require_once "constant.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/reset.css">
  <link rel="stylesheet" href="css/style.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <title>Ou Est Richardeau ?</title>
</head>

<body class="index">

  <a href="/" class="indextitle">Ou Est Richardeau ?</a>

  <form action="login.php" method="post" id="form">
    <?php


    if (isset($_GET['error'])) {
      switch ($_GET['error']) {
        case "no_room":
          echo "<p style='color: red;'>No room available</p>";
          break;
        case "wrong_login":
          echo "<p style='color: red;'>Wrong login</p>";
          break;
        case "wrong_room":
          echo "<p style='color: red;'>Wrong room</p>";
          break;
        default:
          echo "<p style='color: red;'>Unknown error</p>";
      }
    }


    ?>
    <input type="text" name="username" placeholder="Ton nom..." required>

    <button type="submit">Rejoindre</button>
  </form>

  <?php if (isset($_SESSION['admin'])) { ?>
    <a href="logout.php" class="adminbtn">LOGOUT</a>
    <?php } else { ?>
      <a href="login.php" class="adminbtn">ADMIN</a>
  <?php } ?>

  <div class="ending"></div>

  <script src="js/anim.js"></script>
  <!-- <div class="base-timer">
    <svg class="base-timer__svg" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
      <g class="base-timer__circle">
        <circle class="base-timer__path-elapsed" cx="50" cy="50" r="45"></circle>
        <path id="base-timer-path-remaining" stroke-dasharray="283" class="base-timer__path-remaining" d="
          M 50, 50
          m -45, 0
          a 45,45 0 1,0 90,0
          a 45,45 0 1,0 -90,0"></path>
      </g>
    </svg>
    <span id="base-timer-label" class="base-timer__label"></span>
  </div>

  <div class="footer">
    <input type="number" id="timer-input" value="0" />
    <button id="set-timer-button" class="button-80" role="button" onclick="setTimer()"> SET TIMER</button>

    <button id="start-button" class="button-80" role="button" onclick="startTimer()">START</button>
    <button id="stop-button" class="button-80" role="button" onclick="stopTimer()">STOP</button>
    <button id="reset-button" class="button-80" role="button" onclick="resetTimer()">RESET</button>
  </div> -->

</body>

</html>