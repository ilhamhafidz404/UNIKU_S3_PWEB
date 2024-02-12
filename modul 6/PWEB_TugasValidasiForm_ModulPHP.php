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
    <input type="password" placeholder="Password..." name="password">
    <br>
    <button name="submit">Submit</button>
  </form>
  <?php
  if (isset($_POST["submit"])) {
    extract($_POST);

    if (!$email && !$password) {
      echo "Tolong isi email dan password";
    } else {
      echo "Halo " . $email;
    }
  }
  ?>
</body>

</html>