<?php
session_start();


if (!isset($_SESSION["signin"])) {
    // jika session nya tidak ada
    header("Location: signin.php");
    // echo "SESSION NYA TIDAK ADA!";
}
$level = $_SESSION["level"];


if ($level !== "pembeli") {
    echo "<script>alert('You cannot permission!');</script>";
    echo "<script>location='./admin/index.php'</script>";
}
require_once("../app.php");

$productMigo = queryData("SELECT * FROM products");


?>
<?php
require_once("../src/layouts/header.php");
require_once("../src/layouts/navigation.php");
?>


<section>
    <div class="container">
        <h2>Produk Favorite</h2>

        <div style="display: flex; ">
            <?php foreach ($productMigo as $migo) : ?>

                <div class="card-favorite-migo">
                    <a href="detailMigo.php?productId=<?= $migo["id_migo"]; ?>">
                        <img src="./assets/images/<?= $migo["gambar"]; ?>" width="100%" alt="" style="border: 1px solid #ddd; border-radius: 5px;">
                    </a>
                    <div style="padding: 10px; display: flex; align-items: center;justify-content: space-between;">
                        <h3 style="  width: 200px; white-space: nowrap;overflow: hidden; text-overflow: ellipsis;"><?= $migo["nama"]; ?></h3>
                        <h3>Rp <?= number_format($migo["harga"]); ?></h3>
                    </div>
                    <div style="padding: 0px 10px 0px 10px; margin-top: 10px; ">
                        <h4>Stok Migo Tersedia: <?= $migo["stock"]; ?></h4>
                        <p style="margin-top: 10px;">Deskripsi:<?= $migo["deskripsi"]; ?></p>
                    </div>

                </div>

            <?php endforeach; ?>

        </div>

    </div>
</section>