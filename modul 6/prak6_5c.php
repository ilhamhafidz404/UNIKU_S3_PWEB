<?php
extract($_POST);
$HASIL = "";
if (isset($tombol_cek)) {
    if ($bilangan % 2 == 0) {
        $HASIL = "$bilangan Termasuk Bilangan Genap";
    } else {
        $HASIL = "$bilangan Termasuk Bilangan Ganjil";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Modul 6 Praktikum 5c</title>
</head>

<body>
    <form name="form1" method="post">
        Menentukan Jenis Bilangan <br>
        Masukan Bilangan : <input type="number" name="bilangan">
        <br>
        <input type="SUBMIT" name="tombol_cek" value="cek">         <br><br>

        Jenis Bilangan :
        <input type="text" name="hasil_cek" value="<?php echo $HASIL; ?>" readonly size="35">    
    </form>
</body>

</html>