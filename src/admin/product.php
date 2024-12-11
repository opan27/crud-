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
        .column-card {
            display: flex;
            flex-wrap: wrap;
            gap: 4rem;
            margin-top: 50px;
        }

        .card-product {
            background-color: darkslateblue;
            padding: 10px;
            width: 18rem;
            margin: 4px;
            border-radius: 5px;
            font-family: "Poppins", sans-serif;
            color: #fff;
            cursor: pointer;
        }

        .action-product {
            text-align: center;
            color: #FFFFFF;
            text-decoration: none;
        }

        .action-product a {
            color: #FFFFFF;
            text-decoration: none;
        }

        .action-product .edit-product {
            color: black;
            font-weight: bold;
            text-decoration: none;
            margin-top: 20px;
        }

        .action-product .hapus-product {
            color: gray;
            margin-top: 20px;
            font-weight: bold;
            text-decoration: none;
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
                <div class="card-product">
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
                        <a href="edit-admin.php?id=<?= $item["id_migo"]; ?>" class="edit-product">Edit</a>
                        <a href="hapus-admin.php?id=<?= $item["id_migo"]; ?>" onclick="alert('Apakah anda ingin menghapus <?= $item['nama']; ?>?');" class="hapus-product">Hapus</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

</body>

</html>