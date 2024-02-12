<?php
$a = "";
if (isset($_POST['tombol'])) {
    $a = $_POST['nama'];
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Modul 6 Praktikum 3c</title>
</head>

<body>
    <form name="form1" method="post">
        Nama <input type="text" name="nama" id="NAMA" value="<?php echo $a; ?>"> <br>
        <input type="submit" name="tombol" value="SHOW">
    </form>
</body>

</html>