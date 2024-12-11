<?php
session_start();
require("../app.php");

if (empty($_SESSION["cart"] || isset($_SESSION["cart"]))) {
    echo "<script>alert('Keranjang kosong, silahkan berbelanja terlebih dahulu');</script>";
    echo "<script>location='index.php';</script>";
} else if (!isset($_SESSION["cart"])) {
    echo "<script>location='index.php';</script>";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="assets/css/cart.css">
    <link rel="stylesheet" href="assets/css/style.css">

    <title>Your Cart</title>

</head>

<body>
    <?php require('./layouts/navigation.php') ?>

    <section class="content-cart">
        <div class="parent-left">
            <div style="display: flex; justify-content: space-between;">
                <h2>Keranjang</h2>

                <a href="checkout-product.php" style="margin-top: 7px; text-decoration: none; color: #fff; font-weight: bold; background: #000; padding: 6px; margin: 2px; border-radius: 10px;">Bayar Sekarang</a>

            </div>
            <hr>

            <?php foreach ($_SESSION["cart"] as $productId => $hasil) : ?>
                <?php
                $data = queryData("SELECT * FROM products WHERE id_migo = $productId")[0];
                $subtotalHarga = $hasil * $data["harga"];
                ?>
                <div class="card-cart">
                    <img src="assets/images/<?= $data["gambar"]; ?>" width="20%" alt="">
                    <div class="child-cart">
                        <h4><?= $data["nama"]; ?></h4>
                        <h4 style="margin-top: 10px;">Rp <?= number_format($data["harga"]); ?></h4>
                        <h4 style="margin-top: 10px;">Pembeli: <?= $_SESSION["username"]; ?></h4>
                        <h4 style="margin-top: 10px;">Total Harga: Rp <?= number_format($subtotalHarga); ?></h4>
                        <div class="action-cart">
                            <a href="cart-delete.php?id=<?= $data["id_migo"]; ?>">Hapus</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

        </div>

    </section>

</body>

</html>