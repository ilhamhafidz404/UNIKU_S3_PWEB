<?php
extract($_GET);
$na = "";
if (isset($tampil)) {
    switch ($nilai_huruf) {
        case "A":
            $na = 4;
            break;
        case "B":
            $na = 3;
            break;
        case "C":
            $na = 2;
            break;
        case "D":
            $na = 1;
            break;
        case "E":
            $na = 0;
            break;
        default:
            $na = "";
    }
}
?>

<!DOCTYPE html>

<head>
    <title>Modul 6 Praktikum 6</title>
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