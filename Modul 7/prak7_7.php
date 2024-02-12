<?php
session_start();
session_unset();
session_destroy();
header("location:prak7_5.php");
