<?php
session_start();

$productId = $_GET["id"];


if (isset($_SESSION["cart"][$productId])) {
    $_SESSION["cart"][$productId] += 1;
} else {
    $_SESSION["cart"][$productId] = 1;
}
echo "<script>alert('Produk telah ditambahkan ke keranjang belanja')</script>";
echo "<script>location='cart.php'</script>";
