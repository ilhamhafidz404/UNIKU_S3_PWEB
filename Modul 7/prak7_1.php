<!DOCTYPE html>
<html lang="en">

<head>
    <title>Cookie</title>
</head>

<body>
    <form name="form1" method="post" action="prak7_2.php">
        <table border="1">
            <tr>
                <td>Nama Lengkap</td>
                <td><input type="text" name="nama"></td>
            </tr>
            <tr>
                <td>Jabatan</td>
                <td><select name="jabatan">
                        <option value="admin">admin</option>
                        <option value="kasir">kasir</option>
                        <option value="gudang">gudang</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td colspan="2"><input type="submit" name="cek" value="cek">
                    <input type="reset" name="batal" value="batal">
                </td>
            </tr>
        </table>
    </form>
</body>

</html>