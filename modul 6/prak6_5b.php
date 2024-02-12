<?php
extract($_POST);
if (isset($tombol_cek)) {
    if ($bilangan % 2 == 0) {
        echo "<script> alert('$bilangan Termasuk Bilangan Genap');</script>";
    } else {
        echo "<script> alert('$bilangan Terkmasuk Bilangan Ganji');</script>";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Modul 6 Praktikum 5b</title>
</head>

<body>
    <form name="form1" method="post">
        Menentukan Jenis Bilangan <br>
        Masukan Bilangan : <input type="number" name="bilangan">
        <input type="SUBMIT" name="tombol_cek" value="cek">
    </form>
</body>

</html>