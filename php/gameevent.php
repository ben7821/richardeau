<?php

require_once "lib/Connexion.php";

if (isset($_GET['action']) && !empty($_GET['action']) && isset($_GET['room'])) {
  $action = $_GET['action'];
  $room = $_GET['room'];

  if ($action == "getmap") {

    $sql = "SELECT * FROM jouer INNER JOIN map ON jouer.IDMAP = map.ID WHERE IDROOM = ? AND ORDRE = ?";

    $db = Connexion::login();
    $res = $db->prepare($sql);
    $res->execute(array($room, $_POST['order']));

    $data = $res->fetchAll(PDO::FETCH_ASSOC);
  } else if ($action == "updateplayerscore") {

    $sql = "UPDATE player SET SCORE = ? WHERE IDROOM = ? AND LIB = ?";

    $db = Connexion::login();
    $res = $db->prepare($sql);
    $res->execute(array($_POST['score'], $room, $_POST['player']));

    $data = $res->fetchAll(PDO::FETCH_ASSOC);
  }

  $db = Connexion::logout();

  echo '{"data": ' . json_encode($data) . '}';
}

?>