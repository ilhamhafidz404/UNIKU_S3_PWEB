<?php

$formData = [
  "kodeBarang" => "",
  "jumlahBeli" => "",
  "namaBarang" => "",
  "harga" => "",
  "jumlahBayar" => "",
  "potongan" => [
    "harga" => "",
    "persen" => "",
    "persenInput" => ""
  ],
  "totalBayar" => "",
];

if (isset($_POST["tampilkan"])) {
  extract($_POST);

  $namaBarangMap = [
    "B001" => [
      "nama" => "Buku",
      "harga" => 5000,
    ],
    "B002" => [
      "nama" => "Penggaris",
      "harga" => 1500,
    ],
    "B003" => [
      "nama" => "Pulpen",
      "harga" => 2000,
    ],
  ];

  $jumlahBayar = $namaBarangMap[$kode]["harga"] * $jumlahBeli;
  $persenPotongan = ($jumlahBeli <= 10) ? 0.05 : (($jumlahBeli >= 11 && $jumlahBeli <= 20) ? 0.10 : 0.15);
  $potonganHarga = $jumlahBayar  * $persenPotongan;
  $totalBayar = $jumlahBayar  - $potonganHarga;

  $formData = [
    "kodeBarang" => $kode,
    "jumlahBeli" => $jumlahBeli,
    "namaBarang" => $namaBarangMap[$kode]["nama"],
    "harga" => $namaBarangMap[$kode]["harga"],
    "jumlahBayar" => $jumlahBayar,
    "potongan" => [
      "persen" => $persenPotongan,
      "harga" => $potonganHarga,
      "persenInput" => ($jumlahBeli <= 10) ? 5 : (($jumlahBeli >= 11 && $jumlahBeli <= 20) ? 10 : 15)
    ],
    "totalBayar" => $totalBayar
  ];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Tugas 4</title>
</head>

<body>
  <form action="" method="POST">
    <table border="1">
      <tr>
        <th colspan="2">Data Penjualan Barang</th>
      </tr>
      <tr>
        <td>Kode</td>
        <td>
          <select name="kode" onchange="pilihKodeBarang()">
            <option value="">--pilih salah satu--</option>
            <option value="B001" <?= ($formData["kodeBarang"] == "B001") ? "selected" : ""; ?>>B001</option>
            <option value="B002" <?= ($formData["kodeBarang"] == "B002") ? "selected" : ""; ?>>B002</option>
            <option value="B003" <?= ($formData["kodeBarang"] == "B003") ? "selected" : ""; ?>>B003</option>
          </select>
        </td>
      </tr>
      <tr>
        <td>Jumlah Beli</td>
        <td>
          <input type="number" name="jumlahBeli" size="10" maxlength="10" value="<?= $formData['jumlahBeli'] ?>" />
        </td>
      </tr>
      <tr>
        <td>Nama Barang</td>
        <td>
          <input type="text" name="namaBarang" value="<?= $formData['namaBarang'] ?>" />
        </td>
      </tr>
      <tr>
        <td>Harga</td>
        <td>
          <input type="number" name="harga" value="<?= $formData['harga'] ?>" />
        </td>
      </tr>
      <tr>
        <td>Jumlah Bayar</td>
        <td>
          <input type="number" name="jumlahBayar" value="<?= $formData['jumlahBayar'] ?>" />
        </td>
      </tr>
      <tr>
        <td>Potongan <input type="number" name="potongan" value="<?= $formData['potongan']['persenInput'] ?>" /> %</td>
        <td>
          <input type="number" name="jumlahPotongan" value="<?= $formData["potongan"]["harga"] ?>" />
        </td>
      </tr>
      <tr>
        <td>Total Bayar</td>
        <td>
          <input type="number" name="totalBayar" value="<?= $formData["totalBayar"] ?>" />
        </td>
      </tr>
      <tr>
        <td colspan="2">
          <button type="submit" name="tampilkan">Tampilkan</button>
        </td>
      </tr>
    </table>
  </form>


  <?php if (isset($_POST["tampilkan"])) : ?>
    <main>
      <h1>Nota Penjualan</h1>
      <p>Kode Barang = <?= $formData["kodeBarang"] ?></p>
      <p>Nama Barang = <?= $formData["namaBarang"] ?></p>
      <p>Harga Barang = <?= $formData["harga"] ?></p>
      <p>Jumlah Beli = <?= $formData["jumlahBeli"] ?></p>
      <p>-----------------------------------------</p>
      <p>Jumlah Bayar = <?= $formData["jumlahBayar"] ?></p>
      <p>Potongan = <?= $formData["potongan"]["harga"] ?></p>
      <p>========================</p>
      <p>Total Bayar = <?= $formData["totalBayar"] ?></p>
    </main>
  <?php endif; ?>

</body>

</html>