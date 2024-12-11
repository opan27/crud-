<?php
session_start();
require('../../app.php');
if (!isset($_SESSION["signin"])) {
    header("Location: signin.php");
}


$level = $_SESSION["level"];
if ($level !== "penjual") {
    echo "
        <script>
            alert('Ooops You Cannot Permission!');
            location='../index.php';
        </script>
    ";
}


$id = $_GET["id"];

if (rejectProduct($id) > 0) {
    echo "
    <script>
        alert('Pembeli di hapus');
        location='order.php';
    </script>
";
} else {
    echo "
        <script>
        alert('anda sudah menghapusnya');
        location='order.php';  
        </script>
    ";
}
