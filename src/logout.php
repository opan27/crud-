<?php
session_start();
session_unset();
session_destroy();
$_SESSION = [];
echo "<script>alert('Anda Telah logout!');</script>";
echo "<script>location='./signin.php'</script>";
