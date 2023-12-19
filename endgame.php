<?php

require_once "php/lib/Connexion.php";

session_start();
if (isset($_GET['room']) && $_GET['room'] == $_SESSION['room']) {
  // end game

  $sql = "SELECT * FROM player WHERE IDROOM = ? ORDER BY SCORE DESC";
  $db = Connexion::login();
  $res = $db->prepare($sql);
  $res->execute(array($_GET['room']));
  $players = $res->fetchAll(PDO::FETCH_ASSOC);

  $winner = $players[0];

  $db = Connexion::logout();

} else {
  //header("Location: index.php");
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/reset.css">
  <link rel="stylesheet" href="css/style.css">
  <title>Fin du jeu</title>
</head>

<body class="index2">
  <div class="endgame">
    <h1>Fin du jeu</h1>
    <h2>Le gagnant est
      <?php echo $winner['LIB']; ?> <br> avec
      <?php echo $winner['SCORE']; ?> points
    </h2>
    <h4 class="thanks">Merci d'avoir joué !</h4>
    <a href="index.php">Retour à l'accueil</a>
  </div>
</body>

</html>