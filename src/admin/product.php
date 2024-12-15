<?php
session_start();
require('../../app.php');

if (!isset($_SESSION["signin"])) {
    // jika session nya tidak ada
    header("Location: signin.php");
    // echo "SESSION NYA TIDAK ADA!";
}


$level = $_SESSION["level"];

if ($level !== "penjual") {
    header("Location: ../index.php");
}

$product = queryData("SELECT * FROM products ORDER BY id_migo ASC");

if (!$product) {
    echo "
        <script>
            alert('produk tidak ada!');
            location='index.php';
        </script>
    ";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../assets/css/style.css">

    <style>
        @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap");

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: "Poppins", sans-serif;
}

body {
    background: linear-gradient(135deg, #71b7e6, #9b59b6);
    min-height: 100vh;
    padding: 20px 10px;
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 16px;
    color: #333;
}

.container {
    width: 100%;
    max-width: 1200px;
    background-color: #fff;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
}

/* Heading */
h3 {
    font-size: 2rem;
    font-weight: 600;
    color: #333;
    margin-bottom: 20px;
    text-align: center;
}

/* Link to main page */
.container a p {
    /* background: red; */
    position: relative;
    left:50%;
    transform: translateX(-50%);
    text-align: center;
    font-size: 16px;
    color: #007bff;
    text-decoration: none;
    font-weight: 600;
    margin-top: 10px;
    width:200px
}

/* Flex container for product cards */
.column-card {
    display: flex;
    flex-wrap: wrap;
    gap: 30px;
    justify-content: center;
    margin-top: 40px;
}

/* Individual product card */
.card-product {
    background-color: #fff;
  border: 1px solid #ddd;
  border-radius: 10px;
  margin: 15px;
  padding: 0px 10px 20px 10px; /* Tambahkan padding bawah untuk memberi ruang */
  width: 300px;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  display: flex;
  flex-direction: column; /* Mengatur tata letak elemen secara vertikal */
  justify-content: flex-start; /* Menjaga agar elemen tidak terpusat */
}

.card-product:hover {
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
  transform: translateY(-5px);
}

/* Product image */
.card-product img {
    border-radius: 10px;
  width: 250px;
  height: 250px;
}

/* Product details */
.card-product h3 {
    display: flex;
  justify-content: space-between;
  align-items: center;
  margin-top: 10px;
  padding-bottom: 10px; /*
}

.card-product h4 {
    font-size: 1rem;
    color: #fff;
    margin-top: 5px;
}

.card-product p {
    font-size: 1rem;
    color: #ddd;
    margin-top: 10px;
}

/* Actions (Edit and Delete) */
.action-product a {
    color: #fff;
    font-weight: bold;
    text-decoration: none;
   
    margin-bottom: 10px;
    transition: color 0.3s ease;
}

.action-product a:hover {
    color: #ff6347;
}

.edit-product {
    color: #28a745;
}

.hapus-product {
    color: #dc3545;
}

/* Responsive Design */
@media (max-width: 768px) {
    .column-card {
        flex-direction: column;
        gap: 20px;
    }

    .card-product {
        width: 100%;
    }
}

    </style>

    <title>List Product</title>
</head>

<body>

    <div class="container">
        <h3>Produk anda</h3>
        <a href="index.php" style="text-decoration: none; color: #000;">
            <p style="text-align: center;">Kembali ke utama</p>
        </a>

        <div class="column-card">
            <?php foreach ($product as $item) : ?>
                <div class="card-product" style="display: flex; justify-content: center;">
                    <a href="">
                        <img src="../assets/images/<?= $item["gambar"]; ?>" width="100%" height="50%" style="border-radius: 5px;" alt="Image Cat">
                    </a>
                    <div style="display: flex; justify-content: space-between;">
                        <h3 style="font-size: 1rem;"><?= $item["nama"]; ?></h3>
                        <h4>Stok: <?= $item["stock"]; ?></h4>
                    </div>
                    <p style="margin-top: 10px;">Rp. <?= $item["harga"]; ?></p>
                    <p style="margin-top: 10px;"><?= $item["deskripsi"]; ?></p>
                    <div class="action-product">
                        <a href="edit-admin.php?id=<?= $item["id_migo"]; ?>" 
                        class="edit-product"
                        style="margin-right: 10px; color: #28a745; font-weight: bold; text-decoration: none; margin-bottom: 10px; transition: color 0.3s ease;">
                        Edit
                        </a>
                        <a href="hapus-admin.php?id=<?= $item["id_migo"]; ?>" 
                        onclick="alert('Apakah anda ingin menghapus <?= $item['nama']; ?>?');" 
                        class="hapus-product"
                        style="color: #dc3545; font-weight: bold; text-decoration: none; margin-bottom: 10px; transition: color 0.3s ease;">
                        Hapus
                        </a>
                    </div>

                </div>
            <?php endforeach; ?>
        </div>
    </div>

</body>

</html>