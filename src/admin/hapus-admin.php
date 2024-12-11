<?php

session_start();
require('../../app.php');
$id = $_GET["id"];

if (deleteProduct($id) > 0) {
    echo "
        <script>
            alert('Produk berhasil di hapus !');
            location = 'product.php';
        </script>
    ";
} else {
    echo "
        <script>
            alert('Gagal menghapus produk!');
            location = 'product.php';
        </script>
    ";
}
