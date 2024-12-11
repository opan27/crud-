<?php
session_start();
$id = $_GET["id"];

unset($_SESSION["cart"][$id]);
echo "<script>alert('Produk telah terhapus!');</script>";
if (isset($_SESSION["cart"]) < 0) {
    echo "<script>alert('Keranjang anda kosong!');</script>";
}
echo "<script>location='keranjang.php';</script>";
