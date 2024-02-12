<?php
if (isset($_COOKIE['nama_pengguna'])) {
    echo "Welcome " . $_COOKIE['nama_pengguna'];
    echo "<br>Sebagai " . $_COOKIE['level'];

    echo "<br><br><a href=prak7_4.php>Logout</a>";
} else {
    echo "Anda Harus Input Data Terlebih Dahulu!";
    echo "<br><br><a href=prak7_1.php>Input</a>";
}
