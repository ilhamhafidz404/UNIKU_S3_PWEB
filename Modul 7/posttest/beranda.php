<?php
session_start();

if (!isset($_SESSION["login"])) {
  header("Location: login.php");
}

if (isset($_GET["logout"])) {
  session_destroy();
  header("Location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <h1>Halo <?= $_SESSION["username"] ?></h1>

  <a href="beranda.php?logout=true">logout</a>
</body>

</html>