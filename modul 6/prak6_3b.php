<!DOCTYPE html>

<head>
    <title>Modul 6 Praktikum 3b</title>
</head>

<body>
    <?php
    if (isset($_GET['tombol'])) {
        echo "Menampilkan Nama Di Atas Form : <br> 
            Nama Anda = " . $_GET['nama'] . "<br><br>";
    }
    ?>

    <form name="form1" method="get">
        Nama <input type="text" name="nama" id="NAMA"> <br>
        <input type="submit" name="tombol" value="SHOW">
    </form>

    <?php
    if (isset($_GET['tombol'])) {
        echo "<br><br>Menampilkan Nama Di Bawah Form : <br> 
        Nama Anda = " . $_GET['nama'] . "<br>";
    }
    ?>
</body>

</html>