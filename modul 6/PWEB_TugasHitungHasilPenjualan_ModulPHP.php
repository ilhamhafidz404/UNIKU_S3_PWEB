<?php
    $kode= "";
    $jumlahbeli= "";
    $namabarang= "";
    $harga= "";
    $jumlahbayar= "";
    $persenPotongan= "";
    $valuePersenPotongan= "";
    $potongan= "";
    $totalbayar= "";

    if(isset($_POST["tampil"])){
        $kode = $_POST["kode"];
        $jumlahbeli = $_POST["jumlahbeli"];
        $namabarang = $_POST["namabarang"];

        if($kode == "B001"){
            $namabarang= "Buku";
            $harga= 5000;
            $jumlahbayar= $jumlahbeli * $harga;
        } else if($kode == "B002"){
            $namabarang= "Penggaris";
            $harga= 1500;
            $jumlahbayar= $jumlahbeli * $harga;
        } else{
            $namabarang= "Pulpen";
            $harga= 2000;            
            $jumlahbayar= $jumlahbeli * $harga;
        }

        if($jumlahbeli <= 10){
            $valuePersenPotongan="5";
            $persenPotongan= 0.05;
            $potongan = $persenPotongan * $jumlahbayar;

        } else if($jumlahbeli > 10 && $jumlahbeli <= 20){
            $valuePersenPotongan="10";
            $persenPotongan= 0.10;
            $potongan = $persenPotongan * $jumlahbayar;

        } else{
            $valuePersenPotongan="15";
            $persenPotongan= 0.15;
            $potongan = $persenPotongan * $jumlahbayar;

        }

        $totalbayar= $jumlahbayar - $potongan;
    }
    
?>


<!DOCTYPE html>
<html lang="en">
<head>
	<title>Tugas 4</title>
</head>
<body>
	<form action="" method="POST">
		<table border="1">
			<tr>
				<th colspan="2">Data Penjualan Barang</td>
			</tr>
			<tr>
				<td>Kode</td>
				<td>
					<select name="kode">
                        <option value="">--pilih salah satu--</option>
                        <option value="B001">B001</option>
                        <option value="B002">B002</option>
                        <option value="B003">B003</option>
                    </select>
				</td>
			</tr>
			<tr>
				<td>Jumlah Beli</td>
				<td>
					<input type="number" name="jumlahbeli" size="10" maxlength="10" value="<?= $jumlahbeli ?>">	
				</td>
			</tr>
			<tr>
				<td>Nama Barang</td>
				<td>
					<input type="text" name="namabarang" value="<?= $namabarang ?>">
				</td>
			</tr>
			<tr>
				<td>Harga</td>
				<td>
					<input type="number" name="harga" value="<?= $harga ?>">
				</td>
			</tr>
			<tr>
				<td>Jumlah Bayar</td>
				<td>
					<input type="number" name="jumlahbayar" value="<?= $jumlahbayar ?>">
				</td>
			</tr>
            <tr>
                <td>Potongan 
                    <input type="text" name="potongan" value="<?= $valuePersenPotongan ?>">
                    %
                </td>
                <td>
                    <input type="number" name="jumlahPotongan" value="<?= $potongan ?>">
                </td>
            </tr>
            <tr>
				<td>Total Bayar</td>
				<td>
					<input type="number" name="totalbayar" value="<?= $totalbayar ?>">
				</td>
			</tr>
            <tr>
				<td>
					<button name="tampil">TAMPILKAN</button>
				</td>
			</tr>
		</table>

        <h1>Nota Penjualan</h1>
        <p>Kode Barang      = <?= $kode ?></p>
        <p>Nama Barang      = <?= $namabarang ?></p>
        <p>Harga Barang     = <?= $harga ?></p>
        <p>Jumlah Beli      = <?= $jumlahbeli ?></p>
        <P>-----------------------------------------</P>
        <p>Jumlah Bayar     = <?= $jumlahbayar ?></p>
        <p>Potongan         = <?= $potongan ?></p>
        <p>========================</p>
        <p>Total Bayar      = <?= $totalbayar ?></p>
	</form>
    <h1></h1>
    <script>
        function pilihKodeBarang(){
            var kode = form1.kode.value;
            if(kode == "b001"){
                form1.namabarang.value = "Buku";
                form1.harga.value = "5000";
            } else if(kode == "b002"){
                form1.namabarang.value = "Penggaris";
                form1.harga.value = "1500";
            }  else{
                form1.namabarang.value = "Pulpen";
                form1.harga.value = "2000";
            }
        }

        function setPotongan(){
            var jumlahBeli = form1.jumlahbeli.value;
            var harga = form1.harga.value;

            if(jumlahBeli == ""){
                form1.potongan.value = "";

                form1.jumlahbayar.value = parseInt(jumlahBeli) * parseInt(harga);
            } else if(jumlahBeli <= 10){
                form1.potongan.value = "5";
                
                form1.jumlahbayar.value = parseInt(jumlahBeli) * parseInt(harga);
                form1.jumlahPotongan.value = (parseInt(jumlahBeli) * parseInt(harga)) * 0.05;
                form1.totalbayar.value = parseInt(form1.jumlahbayar.value) - parseInt(form1.jumlahPotongan.value);
            }else if(jumlahBeli <= 20){
                form1.potongan.value = "10";
                
                form1.jumlahbayar.value = parseInt(jumlahBeli) * parseInt(harga);
                form1.jumlahPotongan.value = (parseInt(jumlahBeli) * parseInt(harga)) * 0.1;
                form1.totalbayar.value = parseInt(form1.jumlahbayar.value) - parseInt(form1.jumlahPotongan.value);
            } else{
                form1.potongan.value = "15";
                
                form1.jumlahbayar.value = parseInt(jumlahBeli) * parseInt(harga);
                form1.jumlahPotongan.value = (parseInt(jumlahBeli) * parseInt(harga)) * 0.015;
                form1.totalbayar.value = parseInt(form1.jumlahbayar.value) - parseInt(form1.jumlahPotongan.value);
            }
        }
        
        function hit(){
            document.getElementById("kodeBarang").innerHTML = form1.kode.value;
            document.getElementById("namaBarang").innerHTML = form1.namabarang.value;
            document.getElementById("hargaBarang").innerHTML = form1.harga.value;
            document.getElementById("jumlahBeli").innerHTML = form1.jumlahbeli.value;
           document.getElementById("jumlahBayar").innerHTML = form1.jumlahbayar.value;
           document.getElementById("potongan").innerHTML = form1.jumlahPotongan.value;
           document.getElementById("totalBayar").innerHTML = form1.totalbayar.value;
        }
    </script>

</body>
</html>