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
                <h3 style="margin-top: 20px;">Order Id: <?= $order["id_checkout"]; ?></h3>
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