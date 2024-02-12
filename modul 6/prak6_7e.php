<!DOCTYPE html>
<html>

<head>
    <title>Modul 5 Praktikum 73</title>
</head>

<body>
    <form name="form1" method="post">
        Warna Favorit : <br>
        <input type="checkbox" name="wf[]" value="Hitam">Hitam<br>
        <input type="checkbox" name="wf[]" value="Putih">Putih<br>
        <input type="checkbox" name="wf[]" value="Hijau">Hijau<br>
        <input type="checkbox" name="wf[]" value="Biru">Biru<br>
        <br><br>
        Makanan Favorit : <br>
        <input type="radio" name="mt[]" value="Nasi Goreng">Nasi Gorang<br>
        <input type="radio" name="mt[]" value="Rendang">Rendang<br>
        <input type="radio" name="mt[]" value="Ayam Bakar">Ayam Bakar<br>
        <input type="radio" name="mt[]" value="Bakso">Bakso<br>
        <br><br>
        <input type="submit" name="tampil" value="SHOW">
    </form>
</body>

</html>
<?php
extract($_POST);
if (isset($tampil)) {
    echo "<b>Warna Favorit Anda : </b><br>";
    foreach ($wf as $warna) {
        echo $warna . "<br>";
    }

    echo "<br><b>Makanan Favorit Anda : </b><br>";
    foreach ($mt as $makanan) {
        echo $makanan . "<br>";
    }
}
