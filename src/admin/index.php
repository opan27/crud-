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
 @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap");

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: "Poppins", sans-serif;
}

body {
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 10px;
    background: linear-gradient(135deg, #71b7e6, #9b59b6);
}

/* Card container for the product form */
.container {
    width: 100%;
    max-width: 900px;
    background-color: #fff;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
}

/* Navbar links */
.nav-menu {
    display: flex;
    justify-content: space-around;
    margin-bottom: 30px;
}

.nav-menu a {
    text-decoration: none;
    color: #000;
    font-weight: 600;
    font-size: 16px;
    padding: 10px 15px;
    background-color: #f0f0f0;
    border-radius: 6px;
    transition: background-color 0.3s ease;
}

.nav-menu a:hover {
    background-color: #007bff;
    color: #fff;
}

/* Title of the page */
.column h1 {
    text-align: center;
    font-size: 28px;
    font-weight: 600;
    color: #333;
    margin-bottom: 10px;
}

.column p, .column small {
    font-size: 16px;
    color: #555;
}

.column a {
    font-size: 16px;
    color: #007bff;
    text-decoration: none;
    font-weight: 600;
    margin-top: 10px;
}

/* Form section for creating a product */
.form-create-product {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

/* Input fields for text and number */
.input_control,
input[type="number"],
textarea {
    height: 45px;
    width: 100%;
    outline: none;
    font-size: 16px;
    border-radius: 8px;
    padding-left: 15px;
    border: 1px solid #ccc;
    transition: all 0.3s ease;
}

.input_control:focus,
input[type="number"]:focus,
textarea:focus {
    border-color: #9b59b6;
}

input[type="number"] {
    -moz-appearance: textfield;
    -webkit-appearance: none;
    appearance: none;
}

input[type="number"]::-webkit-outer-spin-button,
input[type="number"]::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
}

/* Textarea for product description */
textarea {
    padding: 15px;
    font-size: 16px;
    border-radius: 8px;
    border: 1px solid #ccc;
    resize: vertical;
    min-height: 100px;
}

/* Button */
.btn-product {
    width: 100%;
    padding: 12px;
    background-color: darkslateblue;
    color: #fff;
    border: none;
    border-radius: 8px;
    font-size: 16px;
    font-weight: 600;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.btn-product:hover {
    background-color: #5a3f80;
}

/* Responsive Design */
@media (max-width: 768px) {
    .container {
        padding: 20px;
    }

    .form-create-product {
        gap: 10px;
    }

    .nav-menu {
        flex-direction: column;
        gap: 15px;
    }

    .nav-menu a {
        width: 100%;
        text-align: center;
    }

    .column h1 {
        font-size: 24px;
    }

    .input_control,
    textarea {
        height: 40px;
    }

    .btn-product {
        padding: 10px;
    }
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
            <a href="../logout.php" style="color: #FF7F7F;">Logout</a>
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
                <input type="number" name="stock" id="stock" class="input_control"><br><br>
                <label for="gambar">Gambar</label>
                <input type="file" name="gambar" id="gambar"><br><br>
                <label for="deskripsi">Deskripsi</label>
                <textarea name="deskripsi" id="deskripsi" class="input_control" cols="20" rows="7"></textarea>
                <button type="submit" name="product" class="btn-product">Tambah Produk</button>
            </form>
        </div>

    </div>
</body>

</html>