<?php
$A = [[1, 2, 4], [3, 5, 7]];

echo "<p> SEMUA DATA </P>";
for ($i = 0; $i <= 1; $i++) {
    for ($j = 0; $j <= 2; $j++) {
        echo "baris ke- $i kolom ke- $j + " . $A[$i][$j] . "<br>";
    }
    echo "<br>";
}

echo "<br>====================<br>";
echo "<p>baris ke-0 kolom ke-2 : " . $A[0][2];
