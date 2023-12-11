<?php 

header("Content-Type: text/event-stream");
header("Cache-Control: no-cache");

require_once "lib/Connexion.php";

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