<?php
session_start();

$username = "";
$password = "";

if (isset($_COOKIE["username"]) && isset($_COOKIE["password"])) {
  $username = $_COOKIE["username"];
  $password = $_COOKIE["password"];
}

if (isset($_POST["submit"])) {
  extract($_POST);

  if ($username || $password) {
    if ($password == "password") {

      if (isset($rememberMe)) {
        setcookie("username", $username);
        setcookie("password", $password);
      } else {
        setcookie("username", '', -1);
        setcookie("password", '', -1);
      }

      $_SESSION["login"] = true;
      $_SESSION["username"] = $username;

      return header("Location: beranda.php");
    }
  }

  echo "<script>
    alert('Username atau Password harus diisi!');
  </script>";
}
if (isset($_SESSION["login"])) {
  header("Location: beranda.php");
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
  <form action="" method="POST">
    <label for="username">Username</label>
    <br>
    <input type="text" id="username" placeholder="Username" name="username" value="<?= $username ?>">
    <br><br>
    <label for="password">Password</label>
    <br>
    <input type="password" id="password" placeholder="Password" name="password" value="<?= $password ?>">
    <br><br>
    <input type="checkbox" name="rememberMe" id="rme" <?php if ($username && $password) : ?> checked <?php endif; ?>>
    <label for="rme">Ingat Saya?</label>
    <br><br>
    <button name="submit">Submit</button>
  </form>
</body>

</html>