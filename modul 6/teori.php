<?php

$map = [
  "nama" => "",
  "angkatan" => "",
  "sks" => "",
  "spp" => "",
  "sksDiambil" => "",
  "total" => "",
];

$mapValue = [
  "2020" => [
    "spp" => 1000000,
    "sks" => 150000
  ],
  "2021" => [
    "spp" => 2000000,
    "sks" => 200000
  ],
  "2022" => [
    "spp" => 3000000,
    "sks" => 250000
  ],
  "2023" => [
    "spp" => 4000000,
    "sks" => 300000
  ],
];

if (isset($_POST["submit"])) {

  $map = [
    "nama" => $_POST["nama"],
    "angkatan" => $_POST["angkatan"],
    "sksDiambil" => $_POST["sks"],
    "spp" => $mapValue[$_POST["angkatan"]]["spp"],
    "sks" => $mapValue[$_POST["angkatan"]]["sks"] * $_POST["sks"],
    "total" => $mapValue[$_POST["angkatan"]]["sks"] * $_POST["sks"] + $mapValue[$_POST["angkatan"]]["spp"],
  ];
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hitung Biaya Kuliah</title>
</head>
<form action="" method="POST">
  <table>
    <tr>
      <td>Nama</td>
      <td>
        <input type="text" name="nama" value="<?= $map["nama"] ?>">
      </td>
    </tr>
    <tr>
      <td>Angkatan</td>
      <td>
        <select name="angkatan" id="">
          <option value="">--Pilih Angkatan--</option>
          <option value="2023" <?php if ($map["angkatan"] == "2023") : ?> selected <?php endif; ?>>2023</option>
          <option value="2022" <?php if ($map["angkatan"] == "2022") : ?> selected <?php endif; ?>>2022</option>
          <option value="2021" <?php if ($map["angkatan"] == "2021") : ?> selected <?php endif; ?>>2021</option>
          <option value="2020" <?php if ($map["angkatan"] == "2020") : ?> selected <?php endif; ?>>2020</option>
        </select>
      </td>
    </tr>
    <tr>
      <td>SKS</td>
      <td><input type="text" name="sks" value="<?= $map["sksDiambil"] ?>"></td>
    </tr>
    <tr>
      <td>
        <button name="submit">Hitung</button>
      </td>
    </tr>
  </table>
</form>

<?php if (isset($_POST["submit"])) : ?>
  <main>
    <table>
      <tr>
        <td>Nama: </td>
        <td>
          <?= $map["nama"] ?>
        </td>
      </tr>
      <tr>
        <td>Angkatan: </td>
        <td>
          <?= $map["angkatan"] ?>
        </td>
      </tr>
      <tr>
        <td>SPP: </td>
        <td>
          <?= "Rp " . number_format($map["spp"], 0, '', '.') ?>
        </td>
      </tr>
      <tr>
        <td>SKS:</td>
        <td>
          <?= "Rp " . number_format($map["sks"], 0, '', '.') ?>
        </td>
      </tr>
      <tr>
        <td>Total</td>
        <td>
          <?= "Rp " . number_format($map["total"], 0, '', '.') ?>
        </td>
      </tr>
    </table>
  </main>
<?php endif; ?>

<body>

</body>

</html>