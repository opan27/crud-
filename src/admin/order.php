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
    padding: 20px;
    font-family: "Poppins", sans-serif;
}

/* Header style */
h2 {
    text-align: center;
    font-size: 24px;
    margin-bottom: 20px;
}

/* Link style for "Back to homepage" */
a {
    display: block;
    text-align: center;
    margin-top: 20px;
    text-decoration: none;
}

/* Text Styling for the "Back to Main Page" link */
a p {
    margin: 0;
    font-size: 16px;
    font-weight: 500;
    color: #000;
    transition: color 0.3s ease;
}

/* Hover effect on the link */
a:hover p {
    color: #9b59b6;
    cursor: pointer;
}

/* Table styling */
.table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 30px;
    font-size: 14px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.table th, .table td {
    padding: 12px;
    text-align: center;
    border: 1px solid #ddd;
}

.table th {
    background-color: #9b59b6;
    color: white;
    font-weight: bold;
}

.table td {
    background-color: #f9f9f9;
}

.table tr:nth-child(even) {
    background-color: #f2f2f2;
}

.table tr:hover {
    background-color: #ddd;
}

/* Style for the table content (tbody) */
.tbody {
    text-align: center;
}

/* Accept and Reject product links styling */
.acc-product, .rej-product {
    text-decoration: none;
    font-weight: 700;
    display: inline-block;
    padding: 5px 10px;
    margin-top: 5px;
    border-radius: 4px;
    transition: background-color 0.3s;
}

/* Color for the accept button */
.acc-product {
    color: white;
    background-color: green;
}

.acc-product:hover {
    background-color: darkgreen;
}

/* Color for the reject button */
.rej-product {
    color: white;
    background-color: red;
}

.rej-product:hover {
    background-color: darkred;
}

/* Style for order status text */
.table .status {
    font-weight: bold;
    text-transform: capitalize;
}

.table .status.pending {
    color: orange;
}

.table .status.accept {
    color: green;
}

.table .status.reject {
    color: red;
}

/* Small responsive design for mobile screens */
@media (max-width: 768px) {
    .table {
        font-size: 12px;
    }

    .table th, .table td {
        padding: 8px;
    }

    .acc-product, .rej-product {
        font-size: 12px;
        padding: 4px 8px;
    }
}

    </style>

    <title>List Order</title>
</head>

<body>

    <div class="container">
        <div>
            <h2 style="text-align: center;">List Pembeli</h2>
            <a href="index.php">
                <p style="text-align: center; margin-top: 20px; color:#007bff;">Kembali ke halaman utama</p>
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