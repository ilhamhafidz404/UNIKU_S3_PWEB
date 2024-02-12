<?php
session_start();

$products = [
  [
    "kode" => "A001",
    "nama" => "DELL Vostro",
    "img" => "./dellVostro.jpg"
  ],
  [
    "kode" => "A002",
    "nama" => "ASUS ROG",
    "img" => "./asusROG.webp"
  ],
  [
    "kode" => "A003",
    "nama" => "MacBook Pro",
    "img" => "./macBookPro.jpg"
  ],
  [
    "kode" => "A004",
    "nama" => "Lenovo Thinkpad",
    "img" => "./lenovoThinkpad.jpg"
  ],
];

if (isset($_GET["nama"]) && isset($_GET["img"])) {
  $_SESSION["keranjang"][] = [
    "nama" => $_GET["nama"],
    "img" => $_GET["img"],
  ];

  header("Location: ./tugas.php");
}

if (isset($_GET["hapus"])) {
  unset($_SESSION["keranjang"][$_GET["hapus"]]);

  header("Location: ./tugas.php");
}

if (isset($_GET["hapusSemua"])) {
  session_destroy();

  header("Location: ./tugas.php");
}
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Bootstrap demo</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <link rel="stylesheet" href="./css/bootstrap.min.css">
</head>

<body>

  <div class="container mt-5">
    <h1 class="text-center mb-3">ILHAM STORE</h1>
    <div>
      <div class="input-group mb-3">
        <input type="text" class="form-control" placeholder="Cari Barang">
        <button class="btn btn-primary" type="button">Search</button>
      </div>

    </div>
    <div class="row mt-5">
      <?php foreach ($products as $product) : ?>
        <div class="col-3">
          <div class="card">
            <img src="<?= $product["img"] ?>" class="card-img-top" style="height: 200px; object-fit: cover">
            <div class="card-body">
              <h6 class="card-title"><?= $product["nama"] ?></h6>
              <a onclick="return confirm('Yakin ingin menambah ke keranjang?')" href="./tugas.php?nama=<?= $product["nama"] ?>&img=<?= $product["img"] ?>" class="btn btn-primary d-block mt-3 btn-sm">
                Tambah ke keranjang
              </a>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>

    <div class="bg-light p-5 rounded mt-5 row border mb-5">
      <div class="col-6">
        <h2>Keranjang Kamu</h2>
      </div>
      <div class="col-6 text-end">
        <a onclick="return confirm('Yakin ingin menghapus semua keranjang?')" href="./tugas.php?hapusSemua=1" class="btn btn-outline-danger btn  -sm">
          Hapus Semua Keranjang
        </a>
      </div>
      <?php if (isset($_SESSION["keranjang"])) : ?>
        <?php foreach ($_SESSION["keranjang"] as $index => $keranjang) : ?>
          <div class="col-3">
            <div class="card">
              <img src="<?= $keranjang["img"] ?>" class="card-img-top" style="height: 200px; object-fit: cover">
              <div class="card-body">
                <h6 class="card-title"><?= $keranjang["nama"] ?></h6>

                <a onclick="return confirm('Yakin ingin menghapus produk ini dari keranjang?')" href="./tugas.php?hapus=<?= $index ?>" class="btn btn-danger d-block mt-3 btn-sm">
                  Hapus Keranjang
                </a>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      <?php else : ?>
        <h4 class="text-center mt-5">KERANJANG KOSONG</h4>
      <?php endif; ?>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  <script src="./js/bootstrap.bundle.min.js"></script>
</body>

</html>