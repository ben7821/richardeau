<?php

require_once "../lib/Connexion.php";

if (isset($_GET['id']) && isset($_POST['LIB']) && isset($_POST['MAP'])) {
  $db = Connexion::login();
  $sql = "UPDATE room SET LIB = '" . $_POST['LIB'] . "' WHERE ID = " . $_GET['id'];
  $res = $db->prepare($sql);
  $res->execute();

  $selectedMaps = $_POST['MAP'];

  $lastId = $db->lastInsertId();

  $sql = "DELETE FROM jouer WHERE IDROOM = " . $_GET['id'];
  $res = $db->prepare($sql);
  $res->execute();

  foreach ($selectedMaps as $map) {
    $sql = "INSERT INTO jouer (IDROOM, IDMAP) VALUES ( :IDROOM , :IDMAP )";
    $res = $db->prepare($sql);
    $res->bindParam(':IDROOM', $_GET['id']);
    $res->bindParam(':IDMAP', $map);
    $res->execute();
  }

  $db = Connexion::logout();
  header("Location: ../../admin.php");
}

$db = Connexion::login();
$sql = "SELECT * FROM map";
$res = $db->prepare($sql);
$res->execute();
$db = Connexion::logout();

$maps = $res->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit room</title>
  <link rel="stylesheet" href="../../css/style.css">
</head>

<body class="index">

  <form action="editroom.php" method="post" id="form">
    <input type="text" name="LIB" placeholder="Libellé">
    <select name="MAP[]" multiple>
      <?php
      if (count($maps) == 0) {
        echo "<option value=''>No map available</option>";
      }
      foreach ($maps as $map) {
        echo "<option value='" . $map['ID'] . "'>" . $map['LIB'] . "</option>";
      }
      ?>
    </select>
    <button type="submit">Ajouter</button>
  </form>

  <a href="../../admin.php" class="adminbtn">Retour</a>

</body>

</html>