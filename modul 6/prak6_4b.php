<!DOCTYPE html>
<head>
    <title>Modul 6 Praktikum 4b</title>
</head>
<body>
    <form name="form1" method="post">
        Bilangan 1 <input type="number" name="bil_1"> <br>
        + <br>
        Bilangan 2 <input type="number" name="bil_2"> <br>
        <input type="submit" name="hitung" value="=">
        <br>

    <?php
        extract($_POST);
        if(isset($hitung)){
            $bil_3 = $bil_1 + $bil_2;
            echo "Hasil $bil_1 + $bil_2 = <input type=number name=hasil value=$bil_3>";
        }
    ?>
    </form>
</body>
</html>