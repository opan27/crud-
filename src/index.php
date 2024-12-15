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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap");

* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: "Poppins", sans-serif;
}

body {
  background-color: #f9f9f9;
}

.container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 20px;
}

h2 {
  text-align: center;
  color: #333;
  margin-bottom: 30px;
  font-size: 24px;
  font-weight: 600;
}

.card-favorite-migo {
  background-color: #fff;
  border: 1px solid #ddd;
  border-radius: 10px;
  margin: 15px;
  padding: 0px 10px 20px 10px; /* Tambahkan padding bawah untuk memberi ruang */
  width: 300px;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  display: flex;
  flex-direction: column; /* Mengatur tata letak elemen secara vertikal */
  justify-content: flex-start; /* Menjaga agar elemen tidak terpusat */
}

.card-favorite-migo:hover {
  box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
  transform: translateY(-5px);
}

.card-favorite-migo img {
  border-radius: 10px;
  width: 100%;
  height: 250px;
}

.card-favorite-migo .product-info {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-top: 10px;
  padding-bottom: 10px; /* Tambahkan padding bawah untuk memberikan jarak */
}

.card-favorite-migo .product-info h3 {
  font-size: 18px;
  width: 200px;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
  margin: 0;
}

.card-favorite-migo .product-info h3.price {
  font-size: 12px;
  color: #9b59b6;
}

.card-favorite-migo .product-details {
  padding: 0px 10px 10px;
  margin-top: auto; /* Membuat section ini tertekan ke bawah */
}

.card-favorite-migo .product-details h4 {
  font-size: 14px;
  color: #555;
  margin-bottom: 10px;
}

.card-favorite-migo .product-details p {
  font-size: 12px;
  color: #777;
}

@media (max-width: 768px) {
  .card-favorite-migo {
    width: 45%;
  }
}

@media (max-width: 480px) {
  .card-favorite-migo {
    width: 100%;
  }
}

.section-title {
  text-align: center;
  margin-bottom: 20px;
  font-size: 24px;
  font-weight: bold;
}




    
    </style>
</head>
<body>
    
</body>
</html>


<section>
    <div class="container">
        <h2>Produk Favorite</h2>

        <div style="display: flex; ">
            <?php foreach ($productMigo as $migo) : ?>

                <div class="card-favorite-migo">
                    <a href="detailMigo.php?productId=<?= $migo["id_migo"]; ?>">
                        <img src="./assets/images/<?= $migo["gambar"]; ?>" width="100%" alt="" style="border: 1px solid #ddd; border-radius: 5px;">
                    </a>
                    <div class="product-info" style="padding: 10px; display: flex; align-items: center;justify-content: space-between; ">
                        <h3 style="  width: 200px; white-space: nowrap;overflow: hidden; text-overflow: ellipsis; font-size: 18px"><?= $migo["nama"]; ?></h3>
                        <h3 class="price" style="font-size: 12px">Rp.<?= number_format($migo["harga"]); ?></h3>
                    </div>
                    <div class="product-details" style="padding: 0px 10px 0px 10px; margin-top: 10px; ">
                        <h4>Stok Migo Tersedia: <?= $migo["stock"]; ?></h4>
                        <p style="margin-top: 10px;">Deskripsi:<?= $migo["deskripsi"]; ?></p>
                    </div>

                </div>

            <?php endforeach; ?>

        </div>

    </div>
</section>