<?php 

header("Content-Type: text/event-stream");
header("Cache-Control: no-cache");

require_once "lib/Connexion.php";

if (isset($_GET['start']) && $_GET['start'] == true) {
  $db = Connexion::login();
  $sql = "UPDATE room SET LAUNCH = 1 WHERE ID = " . $_GET['room'];
  $res = $db->prepare($sql);
  $res->execute();
  $db = Connexion::logout();
  exit();
}

if (isset($_GET['user']) && $_GET['user'] == true) {
  $db = Connexion::login();
  $sql = "SELECT * FROM room WHERE ID = " . $_GET['room'] . " AND LAUNCH = 1";
  $res = $db->prepare($sql);
  $res->execute();
  $db = Connexion::logout();
  if ($res->rowCount() > 0) {
    echo "data: startGame\n\n";
    flush();
    exit(); 
  }
}

function getPlayers($id) {
  $db = Connexion::login();
  $sql = "SELECT LIB,SCORE FROM player WHERE IDROOM = :id";
  $res = $db->prepare($sql);
  $res->bindParam(':id', $id);
  $res->execute();

  $players = $res->fetchAll(PDO::FETCH_ASSOC);

  usort($players, function($a, $b) {
    return $b['SCORE'] <=> $a['SCORE'];
  });

  $db = Connexion::logout();

  return $players;
}

echo "data: " . json_encode(getPlayers($_GET['room'])) . "\n\n";

flush();

?>