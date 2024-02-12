<?php
extract($_POST);

setcookie('nama_pengguna', $nama);
setcookie('level', $jabatan);

echo "<a href=prak7_3.php>Next</a>";
