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


$id = $_GET["id"];


if (acceptOrder($id) > 0) {
    echo "
        <script>
        alert('Orderan di terima');
        location='order.php';  
        </script>
    ";
} else {
    echo "
        <script>
        alert('Orderan telah di tolak');
        location='order.php';  
        </script>
    ";
}
