<?php
require_once "php/lib/Connexion.php";


if (isset($_POST['username'])) {
  $username = htmlspecialchars($_POST['username']);


  $idRoom = 20;

  // Admin login ----------------
  if (isset($_POST['admin'])) {
    $password = hashMD5Password(htmlspecialchars($_POST['password']));


    // select pour vérifier si l'admin existe
    $sql = "SELECT * FROM administration WHERE USERNAME = '$username' AND MDP = '$password'";

    $db = Connexion::login();
    $res = $db->prepare($sql);
    $res->execute();
    $db = Connexion::logout();

    if ($res->rowCount() > 0) {
      // si oui, on le connecte
      session_start();
      $_SESSION['admin'] = $username;
      header("Location: admin.php");
    } else {
      // si non, on le redirige vers la d'accueil
      header("Location: index.php?error=wrong_login");
    }

    // Player login ----------------
  } else {

    // select pour vérifier une room disponible
    //$sql = "SELECT ID FROM room WHERE VALID = ? AND CREATED = ? ORDER BY CREATED ASC";

    //$db = Connexion::login();
    //$resRoom = $db->prepare($sql);
    //$resRoom->execute(array(1, "2023-12-07"));

    //$resuRoom = $resRoom->fetch(PDO::FETCH_ASSOC);

    // si oui, on ajoute le joueur
    //if ($resRoom->rowCount() > 0) {

      // select pour vérifier si le joueur existe
      $sql = "SELECT * FROM player WHERE LIB = ? AND IDROOM = ?";
      $res = $db->prepare($sql);
      $res->execute(array($username, $idRoom));

      // si le joueur existe
      if ($res->rowCount() > 0) {
        header("Location: index.php?error=wrong_login");
      }

      // on l'ajoute
      $sql = "INSERT INTO player (LIB, SCORE, IDROOM) VALUES (?, ?, ?)";

      $resInsert = $db->prepare($sql);
      $resInsert->execute(array($username, 0, $idRoom));

      // on le connecte avec les variables de session
      session_start();
      $_SESSION['player'] = $username;
      $_SESSION['room'] = $idRoom;

    //} else {
      // si non, on le redirige vers la d'accueil
    //  header("Location: index.php?error=no_room");
    //}

    $db = Connexion::logout();

    // si tout est ok, on le redirige vers la room
    header("Location: room.php?room=" . $idRoom);
    die();
  }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Login</title>
  <link rel="stylesheet" href="css/style.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body class="index area-2">
<ul class="circles">
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
    </ul>
    
  <form action="login.php" method="post" id="form">
    <h1 class="indextitle">Administration</h1>
    <input type="text" name="username" placeholder="Username" required>
    <input type="password" name="password" placeholder="Password" required>

    <input type="hidden" name="admin" value="1">
    <button type="submit">Login</button>
  </form>

  <div class="ending"></div>
  <a href="index.php" class="adminbtn">USER</a>
  <script src="js/anim.js"></script>
</body>

</html>