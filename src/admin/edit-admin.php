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

        .column-card {
            display: flex;
            flex-wrap: wrap;
            gap: 4rem;
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
        }

        .action-product .hapus-product {
            color: gray;
            font-weight: bold;
            text-decoration: none;
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
            <a href="./admin/index.php">Go Back</a>
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