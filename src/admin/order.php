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

$orderList = queryData("SELECT * FROM checkout ORDER BY id_checkout ASC");


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../assets/css/style.css">

    <style>
        .table {
            width: 100%;
            margin-top: 50px;
        }

        .tbody {
            text-align: center;
        }

        .acc-product {
            text-decoration: none;
            color: green;
            font-weight: 700;
        }

        .rej-product {
            text-decoration: none;
            color: red;
            font-weight: 700;
        }
    </style>

    <title>List Order</title>
</head>

<body>

    <div class="container">
        <div>
            <h2 style="text-align: center;">List Pembeli</h2>
            <a href="index.php" style="text-decoration: none; color: #000;">
                <p style="text-align: center; margin-top: 20px;">Kembali ke halaman utama</p>
            </a>
        </div>

        <table border="1" cellspacing="0" class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Pembeli</th>
                    <th>Kota</th>
                    <th>Kode Pos</th>
                    <th>Pengiriman</th>
                    <th>Pembayaran</th>
                    <th>Alamat</th>
                    <th>Status</th>
                    <th>Tanggal Order</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody class="tbody">
                <?php
                $no = 1;
                foreach ($orderList as $order) : ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $order["nama_pembeli"]; ?></td>
                        <td><?= $order["nama_kota"]; ?></td>
                        <td><?= $order["kode_pos"]; ?></td>
                        <td><?= $order["jenis_pengiriman"]; ?></td>
                        <td><?= $order["jenis_pembayaran"]; ?></td>
                        <td><?= $order["alamat"]; ?></td>
                        <td>
                            <?php if ($order["status"] === "pending") : ?>
                                <p><?= $order["status"]; ?></p>
                            <?php elseif ($order["status"] === "accept") : ?>
                                <p style="color: green;"><?= $order["status"]; ?></p>
                            <?php elseif ($order["status"] === "reject") : ?>
                                <p style="color: red;"><?= $order["status"]; ?></p>
                            <?php endif; ?>

                        </td>
                        <td><?= date("M-d-Y h:m:s", strtotime($order["waktu_belanja"])) ?></td>
                        <td>
                            <a href="accept-product.php?id=<?= $order["id_checkout"]; ?>" class="acc-product">Accept</a>
                            <a href="reject-product.php?id=<?= $order["id_checkout"]; ?>" class="rej-product">Reject</a>
                        </td>
                    </tr>

                <?php endforeach; ?>
            </tbody>

        </table>


    </div>

</body>

</html>