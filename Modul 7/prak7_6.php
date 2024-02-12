<?php
extract($_POST);
session_start();
if (isset($nama)) {
    $_SESSION['nama_pengguna'] = $nama;
    $_SESSION['level'] = $jabatan;

    echo "Nama " . $_SESSION['nama_pengguna'];
    echo "<br>Jabatan " . $_SESSION['level'];

    echo "<br><br><a href=prak7_7.php>Logout</a>";
} else {
    echo "Anda Harus Input Data Terlebih Dahulu! <br>";
    echo "<a href=prak7_5.php>Input</a>";
}
