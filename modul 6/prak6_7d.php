<?php
$warna = ["Hitam", "Biru", "Hijau", "Putih"];
$angka = [5, 7.5, 8, 10.5];

echo "Menampilkan warna index-2 : $warna[2] <br>";
echo "Menampilkan warna index-3 : $warna[3] <br>";

echo "<p>Menampilkan seluruh warna :   </p>";
unset($warna[2]);
$warna[3] = "Merah";
foreach ($warna as $wr) {
    echo "$wr <br>";
}
echo "<p>Menampilkan seluruh angka :   </p>";
foreach ($angka as $ak) {
    echo "$ak <br>";
}
