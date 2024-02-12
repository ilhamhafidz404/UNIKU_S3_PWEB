<!DOCTYPE html>
<html>

<head>
    <title>Modul 6 Praktikum 3a</title>
</head>

<body>
    <?php
    if (isset($_POST['tombol'])) {
        echo "Menampilkan Nama Di Atas Form : <br> 
            Nama Anda = " . $_POST['nama'] . "<br>";
    }
    ?>
    <form name="form1" method="post">
        Nama <input type="text" name="nama" id="NAMA"> <br>
        <input type="submit" name="tombol" value="SHOW">
    </form>
    <?php
    if (isset($_POST['tombol'])) {
        echo "Menampilkan Nama Di Bawah Form : <br> 
        Nama Anda = " . $_POST['nama'] . "<br>";
    }
    ?>
</body>

</html>