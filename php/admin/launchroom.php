<?php

require_once "../lib/Connexion.php";

if (isset($_GET['id'])) {
  $db = Connexion::login();
  $sql = "UPDATE room SET VALID = 1 WHERE ID = " . $_GET['id'];
  $res = $db->prepare($sql);
  $res->execute();

  $db = Connexion::logout();

  session_start();
  $_SESSION['room'] = $_GET['id'];
  $_SESSION['player'] = "admin";
  header("Location: ../../room.php?room=" . $_GET['id']);
}

?>