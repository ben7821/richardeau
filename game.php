<?php

require_once "php/lib/Connexion.php";


session_start();
//if (isset($_GET['room']) && $_GET['room'] == $_SESSION['room']) {
if (isset($_GET['room'])) {
  $sql = "SELECT * FROM jouer INNER JOIN map ON jouer.IDMAP = map.ID WHERE IDROOM = ? AND ORDRE = ?";
  $db = Connexion::login();
  $res = $db->prepare($sql);
  $res->execute(array($_GET['room'], $order));

  $maps = $res->fetchAll(PDO::FETCH_ASSOC);

  $player = array();

  if (count($maps) > 0) {
    $map = $maps[0];
    $order++;
    $sql = "SELECT * FROM player WHERE IDROOM = ? AND LIB = ?";
    $db = Connexion::login();
    $res = $db->prepare($sql);
    $res->execute(array($_GET['room'], $_SESSION['player']));

    $player = $res->fetchAll(PDO::FETCH_ASSOC);

  }

  $db = Connexion::logout();
}
// else {
//   header("Location: index.php");
// }
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Jeu</title>
  <link rel="stylesheet" href="css/style.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/hammer.js/2.0.8/hammer.min.js"></script>
</head>

<body>
  <input type="hidden" id="room" value="<?php echo $_GET['room']; ?>">
  <input type="hidden" id="player" value="<?php echo $_SESSION['player']; ?>">
  <div class="game">
    <div class="game-container" id="zoom-container">
      <img class ="zoom-image" src="" alt="" id="imgmap">
    </div>
    <div class="action">
      <button type="button" id="pass">Pass</button>
      <div class="timer">
        <h3 id="timer">00:00</h3>
      </div>
      <button type="button" id="next">Next</button>
    </div>
</body>

<script src="js/base.js"></script>
<script src="js/game.js"></script>
<script src="js/zoom.js"></script>

</html>