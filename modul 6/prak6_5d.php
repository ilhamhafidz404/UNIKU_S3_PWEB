<?php
extract($_GET);
$na = "";
if (isset($tampil)) {
    if ($nilai_huruf == "A") {
        $na = 4;
    } else if ($nilai_huruf == "B") {
        $na = 3;
    } else if ($nilai_huruf == "C") {
        $na = 2;
    } else if ($nilai_huruf == "D") {
        $na = 1;
    } else if ($nilai_huruf == "E") {
        $na = 0;
    }
}
?>

<!DOCTYPE html>

<head>
    <title>Modul 6 Praktikum 5d</title>
</head>

<body>
    <form name="form1" method="get">
        Pilih Nilai Anda :
        <select name="nilai_huruf">
            <option value="-">--Pilih Salah Satu--</option>
            <option value="A">A</option>
            <option value="B">B</option>
            <option value="C">C</option>
            <option value="D">D</option>
            <option value="E">E</option>
        </select>
        <br>
        <input type="submit" name="tampil" value="SHOW">
        <br><br>
        Nilai Mutu : <input type="text" name="nilai_angka" readonly value="<?php echo $na; ?>">
    </form>
</body>

</html>