<?php
$gapok = "";
$tunjangan = "";
$gaji_bersih = "";
$anak = "";
$gol = "";

if (isset($_GET["hitung"])) {
  $gol = $_GET["gol"];
  $anak = $_GET["anak"];

  if ($gol == "I") {
    $gapok = "250000";
    $tunjangan = ($anak * $gapok) * 0.05;
    $gaji_bersih = ($gapok + $tunjangan);
  } else if ($gol == "II") {
    $gapok = "300000";
    $tunjangan = ($anak * $gapok) * 0.01;
    $gaji_bersih = ($gapok + $tunjangan);
  } else {
    $gapok = "350000";
    $tunjangan = ($anak * $gapok) * 0.15;
    $gaji_bersih = ($gapok + $tunjangan);
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>POSTEST</title>
</head>

<body>
  <form action="" name="form1" method="GET">
    <table border="2">
      <tr>
        <th colspan="2">PERHITUNGAN GAJI</td>
      </tr>
      <tr>
        <td>Golongan</td>
        <td>
          <select name="gol">
            <option value="I" <?php if ($gol == "I") : ?> selected <?php endif; ?>>I</option>
            <option value="II" <?php if ($gol == "II") : ?> selected <?php endif; ?>>II</option>
            <option value="III" <?php if ($gol == "III") : ?> selected <?php endif; ?>>III</option>
          </select>
        </td>
      </tr>
      <tr>
        <td>Jumlah Anak</td>
        <td>
          <input type="text" name="anak" size="10" maxlength="10" value="<?= $anak ?>">
        </td>
      </tr>
      <tr>
        <td>
          <button type="submit" name="hitung">Hitung</button>
          <input type="reset" name="batal" value="Cancel">
        </td>
      </tr>
      <tr>
        <td>Gaji Pokok</td>
        <td>
          <input type="text" name="gapok" value="<?= $gapok ?>">
        </td>
      </tr>
      <tr>
        <td>Tunjangan</td>
        <td>
          <input type="text" name="tunjangan" value="<?= $tunjangan ?>">
        </td>
      </tr>
      <tr>
        <td>Gaji Bersih</td>
        <td>
          <input type="text" name="gaji" value="<?= $gaji_bersih ?>">
        </td>
      </tr>
    </table>
  </form>
</body>

</html>