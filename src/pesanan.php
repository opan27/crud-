<?php

session_start();
require('../app.php');
if (!isset($_SESSION["signin"])) {
    header("Location: signin.php");
}

$level = $_SESSION["level"];


if ($level !== "pembeli") {
    echo "
        <script>
        alert('Oops You Cannot Permission!');
        location='./admin/index.php';
        </script>
    ";
}


$nameUser = $_SESSION["username"];
$userOrder = queryData("SELECT * FROM checkout WHERE nama_pembeli = '$nameUser'");
if ($userOrder == null) {
    echo "<script>
     alert('Tidak ada pesanan, maka dari itu pesan lah sekarang juga');
     location='index.php';
    </script>";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="./assets/css/style_history.css">
    <link rel="stylesheet" href="./assets/css/style.css">
    <title>History Order</title>
    <style>
        /* Global Styles */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: "Poppins", sans-serif;
}

body {
    background-color: #f9f9f9;
    font-size: 14px;
    color: #333;
}

.container {
    width: 100%;
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
}

h2 {
    font-size: 28px;
    font-weight: 600;
    color: #333;
    text-align: center;
    margin-top: 20px;
}

/* Card History */
.card-history {
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    margin-bottom: 20px;
}

.card-history h3 {
    font-size: 18px;
    font-weight: 600;
    color: #333;
    margin-bottom: 10px;
}

/* Status Text */
h2, p {
    font-size: 16px;
    color: #555;
}

h2 {
    font-weight: normal;
    margin-top: 20px;
}

h3 {
    font-weight: normal;
    color: #444;
}

/* Success and Error Messages */
h2 {
    color: green;
}

h3 {
    color: red;
}

p {
    color: #888;
    font-size: 14px;
    margin-top: 10px;
}

/* Responsive Styles */
@media (max-width: 768px) {
    .container {
        padding: 15px;
    }

    h2 {
        font-size: 24px;
    }

    .card-history {
        padding: 15px;
    }

    .card-history h3 {
        font-size: 16px;
    }
}

    </style>
</head>

<body>
    <?php require('./layouts/navigation.php'); ?>
    <div class="container">
        <h2 style="text-align: center; margin-top: 20px;">Riwayat Pesanan anda  <?= $nameUser; ?></h2>
        <?php
        foreach ($userOrder as $order) :
        ?>
            <div class="card-history">
                <h3>Nama Pembeli: <?= $order["nama_pembeli"] ?></h3>
                <h3 style="margin-top: 20px;">Order ID: <?= $order["id_checkout"]; ?></h3>
                <h3 style="margin-top: 20px;">Status Order: <?= $order["status"]; ?></h3>
            </div>
            <?php if ($order["status"] === "pending") : ?>
                <h2 style="text-align: center; margin-top: 20px;">Orderan anda segera kami proses, silahkan tunggu ya!</h2>
            <?php elseif ($order["status"] === "accept") : ?>
                <p style="text-align: center;">Silahkan tunggu 2hari kurir kami akan mengantar ke alamat anda</p>
                <h2 style="text-align: center; margin-top: 20px ; color:">Terima Kasih sudah membeli produk dari kami, semoga suka yaa!</h2>
            <?php else : ?>
                <h3 style="text-align: center; margin-top: 20px; color: red;">Mohon maaf orderan anda kami tolak, karena persyaratan dari kami tidak anda tepati!</h3>

            <?php endif; ?>
        <?php endforeach; ?>
    </div>


</body>

</html>