<?php
require('../../app.php');
session_start();

if (!isset($_SESSION["signin"])) {
    // jika session nya tidak ada
    header("Location: signin.php");
    // echo "SESSION NYA TIDAK ADA!";
}

if (isset($_POST["product"])) {
    if (createProduct($_POST) > 0) {
        echo "
            <script>
                alert('Produk berhasil di tambahkan!');
                location='product.php';
            </script>
        ";
    } else {
        echo mysqli_error($dbconnect);
    }
}



$level = $_SESSION["level"];

if ($level !== "penjual") {
    echo "<script>alert('You cannot permission!');</script>";
    echo "<script>location=' ../index.php'</script>";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        .container {
            padding: 16px;
        }

        .column {
            font-family: "Poppins", sans-serif;
            text-align: center;
        }

        .form-create-product {
            display: flex;
            justify-content: center;
            padding: 12px;
            border-radius: 4px;
        }

        .input_control {
            width: 100%;
            padding: 10px 10px 10px 10px;
            border-radius: 8px;
            border: 1px solid gray;

        }

        .input_control:focus {
            border: none;
        }

        label {
            display: block;
            margin-top: 10px;
            font-family: "Poppins", sans-serif;
        }

        .btn-product {
            margin-top: 10px;
            padding: 8px;
            background: darkslateblue;
            color: #FFFFFF;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }


        .nav-menu {
            display: flex;
            justify-content: space-around;
        }

        .nav-menu a {
            text-decoration: none;
            color: #000;
            font-family: 'Poppins', sans-serif;
            font-weight: 800;
        }
    </style>


    <title>Admin Page</title>
</head>

<body>
    <div class="container">
        <div class="nav-menu">
            <a href="product.php">List Produk</a>
            <a href="order.php">List Pembeli</a>
        </div>
        <div class="column">
            <h1 class="title-judul">Selamat datang <?= $_SESSION["username"]; ?></h1>
            <a href="../logout.php">Logout</a>
            <p>You Level is: <?= $_SESSION["level"]; ?></p>
            <small>Tambahkan Produk!</small>
        </div>

        <div class="form-create-product">
            <form method="post" enctype="multipart/form-data">
                <label for="nama">Nama Produk</label>
                <input type="text" name="nama" id="nama" class="input_control">
                <label for="harga">Harga</label>
                <input type="text" name="harga" id="harga" class="input_control">
                <label for="stock">Stok Produk</label>
                <input type="number" name="stock" id="stock" class="input_control">
                <label for="gambar">Gambar</label>
                <input type="file" name="gambar" id="gambar">
                <label for="deskripsi">Deskripsi</label>
                <textarea name="deskripsi" id="deskripsi" class="input_control" cols="20" rows="7"></textarea>
                <button type="submit" name="product" class="btn-product">Tambah Produk</button>
            </form>
        </div>

    </div>
</body>

</html>