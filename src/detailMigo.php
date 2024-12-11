<?php
session_start();

require "../app.php";

$id = $_GET["productId"];

$migoDetail = queryData("SELECT * FROM products WHERE id_migo = $id")[0];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="./assets/css/style_detail.css">
    <link rel="stylesheet" href="./assets/css/style.css">

    <style>
        .hidden {
            visibility: hidden;
        }
    </style>

    <title>Lets Migo</title>
</head>

<body>
    <?php
    require_once("./layouts/navigation.php");
    ?>
    <section>
        <div class="container-detail">
            <img src="./assets/images/<?= $migoDetail["gambar"]; ?>" width="40%" alt="Image <?= $migoDetail["nama"]; ?>">
            <div class="parent-detail" style="margin-left: 100px;">
                <h2 class="title-detail"><?= $migoDetail["nama"]; ?></h2>
                <p class="paragraph-detail"><?= $migoDetail["deskripsi"]; ?></p>
                <div class="quantity-detail">
                    <h4>Stock</h4>
                    <form method="post">

                        <div class="parent-qty">
                            <input type="number" min="1" class="form-control" name="jumlah" value="1">
                        </div>
                        <div style="display: flex;">
                            <span style="margin-top: 22px; font-weight: bold;">Rp.</span>
                            <h3 style="margin-top: 20px;" id="harga"><?= number_format($migoDetail["harga"]); ?></h3>
                        </div>
                        <?php if (isset($_SESSION["signin"])) : ?>
                            <button type="submit" name="beli">Beli</button>
                        <?php endif; ?>
                    </form>

                    <?php if (!isset($_SESSION["signin"])) : ?>
                        <a href="signin.php" class="btn-tocart">Login Dulu!</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

    <?php
    if (isset($_POST["beli"])) {
        $jumlah = $_POST["jumlah"];

        $product = $_SESSION["cart"][$id] = $jumlah;
        if ($product >= 10) {
            unset($_SESSION["cart"][$id]);
            echo "<script>alert('Maaf produk terlalu banyak untuk ditambahkan!')</script>";
            echo "<script>location='index.php'</script>";
        }
        echo "<script>alert('Produk telah ditambahkan ke keranjang belanja')</script>";
        echo "<script>location='keranjang.php'</script>";
    }
    ?>

    <script src="./assets/js/counter.js">

    </script>
</body>

</html>