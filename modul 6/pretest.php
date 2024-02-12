<?php
$nama = "";
$nim = "";
$kelas = "";

if (isset($_POST["submit"])) {

  $nama = $_POST["nama"];
  $nim = $_POST["nim"];
  $kelas = $_POST["kelas"];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pretest</title>
</head>

<body>
  <div>
    <form action="" method="POST">
      <table cellpadding="10">
        <tr>
          <th colspan="3">
            <?php
            if ($nama && $nim && $kelas) {
              echo "";
            } else {
              echo "INPUT ";
            }
            ?>
            BIODATA MAHASISWA
          </th>
        </tr>
        <tr>
          <td>Nama</td>
          <td>:</td>
          <td>
            <?php if ($nama) : ?>
              <?= $nama ?>
            <?php else : ?>
              <input type="text" name="nama">
            <?php endif; ?>
          </td>
        </tr>
        <tr>
          <td>NIM</td>
          <td>:</td>
          <td>
            <?php if ($nim) : ?>
              <?= $nim ?>
            <?php else : ?>
              <input type="text" name="nim">
            <?php endif; ?>
          </td>
        </tr>
        <tr>
          <td>Kelas</td>
          <td>:</td>
          <td>
            <?php if ($kelas) : ?>
              <?= $kelas ?>
            <?php else : ?>
              <input type="text" name="kelas">
            <?php endif; ?>
          </td>
        </tr>
        <tr>
          <td>
            <button name="submit">Submit</button>
          </td>
        </tr>
      </table>
    </form>
  </div>
</body>

</html>