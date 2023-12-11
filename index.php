<?php

require_once "constant.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/reset.css">
  <link rel="stylesheet" href="css/style.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <title>Ou Est Richardeau ?</title>
</head>

<body class="index area">

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
    <a href="/" class="indextitle">Ou Est Richardeau ?</a>
    <?php


    if (isset($_GET['error'])) {
      switch ($_GET['error']) {
        case "no_room":
          echo "<p style='color: red;'>No room available</p>";
          break;
        case "wrong_login":
          echo "<p style='color: red;'>Wrong login</p>";
          break;
        case "wrong_room":
          echo "<p style='color: red;'>Wrong room</p>";
          break;
        default:
          echo "<p style='color: red;'>Unknown error</p>";
      }
    }


    ?>
    <input type="text" name="username" placeholder="Ton nom..." required>

    <button type="submit">Rejoindre</button>
  </form>

  <?php if (isset($_SESSION['admin'])) { ?>
    <a href="logout.php" class="adminbtn">LOGOUT</a>
    <?php } else { ?>
      <a href="login.php" class="adminbtn">ADMIN</a>
  <?php } ?>

  <div class="ending"></div>

  <script src="js/anim.js"></script>
</body>

</html>