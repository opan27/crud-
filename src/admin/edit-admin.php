<?php
session_start();
require('../../app.php');

if (!isset($_SESSION["signin"])) {
    // jika session nya tidak ada
    header("Location: signin.php");
    // echo "SESSION NYA TIDAK ADA!";
}

if (isset($_POST["editProduct"])) {
    if (editProduct($_POST) > 0) {
        echo "
            <script>
                alert('Berhasil di edit ');
                location='index.php';
            </script>
        ";
    } else {
        echo "
        <script>
            alert('Hemm, Failed Edit a Product :(');
            location='edit-admin.php';
        </script>
    ";
    }
}


$level = $_SESSION["level"];

if ($level !== "penjual") {
    echo "<script>alert('You cannot permission!');</script>";
    header('Location: edit.php?id=<?= $_GET["id"];?>');
}

$id = $_GET["id"];

$detail = queryData("SELECT * FROM products WHERE id_migo = '$id'")[0];


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        /* General Styles */
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
    max-width: 1200px;
    margin: 0 auto;
    padding: 16px;
}

.column {
    text-align: center;
    margin-bottom: 40px;
}

/* Form Styling */
.form-create-product {
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    background-color: #fff;
    padding: 30px;
    border-radius: 8px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    width: 100%;
    max-width: 600px;
    margin: 0 auto;
}

/* Input Styles */
.input_control {
    width: 100%;
    padding: 12px;
    margin-top: 10px;
    border-radius: 6px;
    border: 1px solid #ddd;
    font-size: 14px;
    color: #333;
    box-sizing: border-box;
}

.input_control:focus {
    outline: none;
    border-color: #0056b3;
}

textarea.input_control {
    resize: vertical;
}

label {
    display: block;
    font-size: 14px;
    margin-top: 10px;
    color: #555;
}

/* Button Styling */
.btn-product {
    margin-top: 20px;
    padding: 12px 20px;
    background-color: darkslateblue;
    color: #fff;
    font-weight: bold;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.btn-product:hover {
    background-color: #4c6f9b;
}

/* Link Styling */
a {
    text-decoration: none;
    color: #0056b3;
    font-weight: 600;
    transition: color 0.3s ease;
}

a:hover {
    color: #003d80;
}

small {
    display: block;
    margin-top: 10px;
    color: #777;
}

/* Title Styling */
.title-judul {
    font-size: 24px;
    font-weight: bold;
    color: #333;
}

/* Media Queries for Responsiveness */
@media (max-width: 768px) {
    .container {
        padding: 16px;
    }

    .form-create-product {
        padding: 20px;
        width: 90%;
    }
}

@media (max-width: 480px) {
    .title-judul {
        font-size: 20px;
    }

    .input_control, .btn-product {
        width: 100%;
    }
}

    </style>


    <title>Edit Product || Admin</title>
</head>

<body>
    <div class="container">
        <div class="column">
            <h2 class="title-judul"><?= strtoupper($_SESSION["username"]); ?> Edit Produk!</h2>
            <a href="logout.php">Logout</a>
            <br>
            <br>
            <a href="index.php">Go Back</a>
            <p>You Level is: <?= $_SESSION["level"]; ?></p>
            <small>Please Create Product</small>
        </div>

        <div class="form-create-product">
            <form method="post" enctype="multipart/form-data">
                <input type="hidden" name="id_migo" value="<?= $detail["id_migo"] ?>">
                <label for="nama">Product Name</label>
                <input type="text" name="nama" id="nama" class="input_control" value="<?= $detail["nama"]; ?>">
                <label for="harga">Price</label>
                <input type="text" name="harga" id="harga" class="input_control" value="<?= $detail["harga"]; ?>">
                <label for="stock">Stock Product</label>
                <input type="number" name="stock" id="stock" class="input_control" value="<?= $detail["stock"]; ?>">
                <label for="image">Image</label>
                <input type="file" name="gambar" id="gambar" <?= $detail["gambar"]; ?>>
                <label for="deskripsi">Description</label>
                <textarea name="deskripsi" id="deskripsi" class="input_control" cols="20" rows="7"><?= $detail["deskripsi"]; ?></textarea>
                <button type="submit" name="editProduct" class="btn-product">Edit Product</button>
            </form>
        </div>

    </div>
</body>

</html>