<?php
extract($_GET);

$a = "";
$b = "";
$bil_3 = "";

if (isset($hitung)) {
    $a = $bil_1;
    $b = $bil_2;
    $bil_3 = $bil_1 + $bil_2;
}
?>

<!DOCTYPE html>

<head>
    <title>Modul 6 Praktikum 4c</title>
</head>

<body>
    <form name="form1" method="get">
        Bilangan 1 <input type="number" name="bil_1" value="<?php echo $a; ?>"> <br>
        + <br>
        Bilangan 2 <input type="number" name="bil_2" value="<?php echo $b; ?>"> <br>
        <input type="submit" name="hitung" value="=">
        <br>
        Hasil <input type="number" name="hasil" value="<?php echo $bil_3; ?>">
    </form>
</body>

</html>