<!DOCTYPE html>

<head>
    <title>Modul 5 Praktikum 2</title>
</head>

<body>
    <?php
    $a = 10;
    $b = 5;
    $c = $a;
    $d = $a * $b;
    $e = pow($a, 2);
    $f = $b % 2;
    $g = ($e * $f) + $b - $c * $f / $a;
    $h = sqrt($a);
    $i = 8.96;
    $j = "Teknik Informatika";
    $k = 'A';
    $a = $f;
    echo    "Nilai A = $a <br>
                Nilai B =  $b  <br>
                Nilai C =  $c  <br>
                Nilai D =  $d  <br>
                Nilai E =  $e  <br>
                Nilai F =  $f  <br>
                Nilai G =  $g  <br>
                Nilai I =  $i  <br>
                Program Studi = $j <br>
                Nilai Anda = $k <br>
                ===========================<br>
                Nilai H = $h <br>
                
                Nilai H = " . round($h, 0, PHP_ROUND_HALF_UP) . "<br>
                Nilai H = " . round($h, 2, PHP_ROUND_HALF_UP) . "<br>";
    ?>
</body>

</html>