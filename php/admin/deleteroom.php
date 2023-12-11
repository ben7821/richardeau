<?php

require_once "../lib/Connexion.php";

if (isset($_GET['id'])) {
  $db = Connexion::login();
  $sql = "DELETE FROM room WHERE ID = " . $_GET['id'];
  $res = $db->prepare($sql);
  $res->execute();

  $db = Connexion::logout();
  header("Location: ../../admin.php");
}

?>