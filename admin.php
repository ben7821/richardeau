<?php

session_start();
if (!isset($_SESSION['admin'])) {
  header("Location: index.php?error=wrong_login");
}

require_once "php/lib/Connexion.php";

$sql = "SELECT * FROM room ORDER BY CREATED ASC";
$db = Connexion::login();
$res = $db->prepare($sql);
$res->execute();

$rooms = $res->fetchAll(PDO::FETCH_ASSOC);

foreach ($rooms as $key => $room) {
  $sql = "SELECT COUNT(*) as NBMAP FROM jouer WHERE IDROOM = " . $room['ID']." AND IDMAP IS NOT NULL";
  $res = $db->prepare($sql);
  $res->execute();
  $nbMap = $res->fetch(PDO::FETCH_ASSOC);
  $rooms[$key]['MAP'] = $nbMap['NBMAP'] . " / " . $room['NBMAP']." maps";
}

$db = Connexion::logout();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin</title>
  <!-- require jquery and dataTable -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="//cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
  <link rel="stylesheet" href="css/style.css">
</head>

<body class="index area-3">
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

  <h1 class="indextitle">Admin</h1>

  <div class="adminpanel">

    <div class="actions">
      <button id="btn-ajouter">Ajouter</button>
      <button id="btn-modifier">Modifier</button>
      <button id="btn-supprimer">Supprimer</button>
      <button id="btn-lancer">Lancer</button>
    </div>

    <div class="rooms">
      <?php

      foreach ($rooms as $room) {
        $valid = $room['VALID'] == 1 ? "room-valid" : "room-invalid";
        echo "<div class='room $valid' data-id='" . $room['ID'] . "'>";
        echo "<h1>" . $room['LIB'] . "</h1>";
        echo "<h3><i>" . $room['CREATED'] . "</i></h3>";
        echo "<h3><i>" . $room['MAP'] . "</i></h3>";
        echo "</div>";
      }
      ?>
    </div>
  </div>

  <?php if (isset($_SESSION['admin'])) { ?>
    <a href="logout.php" class="adminbtn">LOGOUT</a>
  <?php } ?>

</body>
<script src="js/base.js"></script>
<script src="js/admin.js"></script>

</html>