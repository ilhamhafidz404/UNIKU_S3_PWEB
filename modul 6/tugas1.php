<?php
$error = [
  "email" => "",
  "password" => "",
];

if (isset($_POST["submit"])) {
  extract($_POST);

  if (!$email) {
    $error["email"] = "Email harus diisi!";
  }

  if (!$password) {
    $error["password"] = "Password harus diisi!";
  }

  if ($email && $password) {
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tugas Validasi Form</title>
</head>

<body>
  <form action="" method="POST">
    <input type="email" placeholder="Email..." name="email">
    <br>
    <small style="color: red;"><?= $error["email"] ?></small>
    <br>
    <input type="password" placeholder="Password..." name="password"><br>
    <small style="color: red;"><?= $error["password"] ?></small>
    <br>
    <button name="submit">Submit</button>
    <?php if (!$error["email"] && !$error["password"] && isset($_POST["submit"])) : ?>
      <p style="color: green;">Login Berhasil</p>
    <?php endif; ?>
  </form>
</body>

</html>