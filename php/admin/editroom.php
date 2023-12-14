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
    $sql = "INSERT INTO jouer (IDROOM, IDMAP, ORDRE) VALUES ( :IDROOM , :IDMAP )";
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
$maps = $res->fetchAll(PDO::FETCH_ASSOC);

$sql = "SELECT ID,LIB FROM jouer INNER JOIN map ON jouer.IDMAP = map.ID WHERE jouer.IDROOM = " . $_GET['id'];
$res = $db->prepare($sql);
$res->execute();
$selectedMaps = $res->fetchAll(PDO::FETCH_ASSOC);
$db = Connexion::logout();


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

  <form action="editroom.php" method="post" id="form" class="content">
    <input type="text" name="LIB" placeholder="Libellé" value="<?php echo $_POST['LIB']; ?>">
    <div class="maps">
      <?php foreach ($maps as $map) {
        echo "<button type='button' class='map' onclick='selectMap(this)' value='" . $map['ID'] . "'>" . $map['LIB'] . "</button>";
      } ?>
    </div>
    <!-- drag and drop selected mapsfrom buttons -->
    <div class="preview" ondragover="allowDrop(event)">
      <?php foreach ($selectedMaps as $map) {
        // draggable buttons between selected maps, click to remove, drag and drop to change order
        echo "<button type='button' class='map' onclick='selectMap(this)' value='" . $map['ID'] . "' draggable='true' ondragstart='drag(event)' ondrop='drop(event)'>" . $map['LIB'] . "</button>";
      } ?>
    </div>
    <input type="hidden" name="MAP" id="MAP" value="">
    <button type="submit">Ajouter</button>
  </form>

  <a href="../../admin.php" class="adminbtn">Retour</a>

</body>

<script>
  function selectMap(button) {
    const clone = button.cloneNode(true);
    clone.getAttributeNode('onclick').value = '';
    clone.addEventListener('click', function() {
      this.remove();
    });
    document.querySelector('.preview').appendChild(clone);
  }


  const preview = document.querySelector('.preview');

  const form = document.querySelector('#form');
  form.addEventListener('submit', function(evt) {
    const preview = document.querySelector('.preview');
    const maps = preview.querySelectorAll('.map');
    const input = document.querySelector('#MAP');
    let value = '';
    maps.forEach(function(map) {
      if (value.length > 0) {
        value = value + ',' + map.value;
      } else {
        value = map.value;
      }
    })
    input.value = value;
  })
</script>

</html>