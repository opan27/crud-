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
    <style>
        /* Global Styles */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: "Poppins", sans-serif;
}

body {
    background-color: #f4f4f4;
    color: #333;
}

/* Content Cart */
.cart-content {
    display: flex;
    justify-content: center;
    padding: 20px;
}

/* Left Section */
.cart-parent-left {
    width: 80%;
    background-color: #fff;
    padding: 20px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

.cart-h2 {
    font-size: 24px;
    font-weight: bold;
}

hr {
    margin: 20px 0;
}

/* Button Bayar Sekarang */
.cart-btn {
    text-decoration: none;
    color: #fff;
    font-weight: bold;
    background-color: #000;
    padding: 10px 20px;
    border-radius: 10px;
    transition: background-color 0.3s ease;
}

.cart-btn:hover {
    background-color: #9b59b6;
}

/* Card Cart */
.cart-card {
    display: flex;
    background-color: #f9f9f9;
    padding: 15px;
    margin-bottom: 15px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

.cart-card img {
    width: 20%;
    object-fit: cover;
    border-radius: 5px;
}

.cart-child {
    padding-left: 20px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    width: 80%;
}

.cart-child h4 {
    font-size: 16px;
    color: #333;
}

.cart-action a {
    color: #e74c3c;
    text-decoration: none;
    font-size: 14px;
    margin-top: 10px;
}

.cart-action a:hover {
    text-decoration: underline;
}

/* Responsive Styles */
@media (max-width: 768px) {
    .cart-content {
        flex-direction: column;
        padding: 10px;
    }

    .cart-parent-left {
        width: 100%;
        padding: 10px;
    }

    .cart-card {
        flex-direction: column;
        align-items: center;
    }

    .cart-card img {
        width: 80%;
        margin-bottom: 10px;
    }

    .cart-child {
        padding-left: 0;
        width: 100%;
        align-items: center;
    }

    .cart-child h4 {
        font-size: 14px;
    }

    .cart-action a {
        font-size: 12px;
    }
}

    </style>
</head>

<body>
    <?php require('./layouts/navigation.php') ?>

    <section class="cart-content">
        <div class="cart-parent-left">
            <div style="display: flex; justify-content: space-between;">
                <h2 class="cart-h2">Keranjang</h2>

                <a class="cart-btn" href="checkout-product.php" >Bayar Sekarang</a>

            </div>
            <hr>

            <?php foreach ($_SESSION["cart"] as $productId => $hasil) : ?>
                <?php
                $data = queryData("SELECT * FROM products WHERE id_migo = $productId")[0];
                $subtotalHarga = $hasil * $data["harga"];
                ?>
                <div class="cart-card">
                    <img src="assets/images/<?= $data["gambar"]; ?>" width="20%" alt="">
                    <div class="cart-child">
                        <h4><?= $data["nama"]; ?></h4>
                        <h4 style="margin-top: 10px;">Rp <?= number_format($data["harga"]); ?></h4>
                        <h4 style="margin-top: 10px;">Pembeli: <?= $_SESSION["username"]; ?></h4>
                        <h4 style="margin-top: 10px;">Total Harga: Rp <?= number_format($subtotalHarga); ?></h4>
                        <div class="cart-action">
                            <a href="cart-delete.php?id=<?= $data["id_migo"]; ?>">Hapus</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

        </div>

    </section>

</body>

</html>