<?php
extract($_POST);
if (isset($tombol_cek)) {
    if ($bilangan < 0 || $bilangan >= 50) {
        echo "<script> alert('Nilai yang diinputkan Hanya 0 s.d 49');</script>";
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Modul 6 Praktikun 5a</title>
</head>

<body>
    <form name="from1" method="post">
        Menentukan Jenis Bilangan <br>
        Masukan Bilangan : <input type="number" name="bilangan">
        <input type="SUBMIT" name="tombol_cek" value="cek">
    </form>
</body>

</html>