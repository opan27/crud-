<?php

require('../app.php');
session_start();

if (empty($_SESSION["cart"]) || !isset($_SESSION["cart"])) {
    echo "<script>
        alert('Keranjang anda kosong nih, belanja dulu yuk!');
        location='index.php';
    </script>";
}

$checkoutId = $_SESSION["cart"];

if (!isset($_SESSION["signin"])) {
    header("Location: index.php");
}

if (isset($_POST["checkout"])) {
    if (checkout($_POST) > 0) {
        echo "<script>
        alert('Terima kasih anda sudah membeli produk dari kami!');
        alert('Semoga senang ya dengan produknya!');
        location='pesanan.php';
    </script>";
    } else {
        //     echo "<script>
        //     alert('Mohon maaf gagal membuat checkout! cek lagi yu!');
        //     location='checkout-product.php';
        // </script>";
        echo mysqli_error($dbconnect);
    }
}

?>

<?php require('./layouts/header.php'); ?>
<?php require('./layouts/navigation.php'); ?>


<div class="container">

    <div class="content-title">
        <h2 class="title">Silahkan Lengkapi Pembayaran Berikut, untuk membeli produk</h2>
        <p class="child-title">Perhatikan setiap pengisian form, karena jika salah bukan kesalahan kami</p>
    </div>

    <div class="content-checkout">
        <div class="card-form">
            <h3>Form Transaksi</h3>

            <form method="post">
                <div class="form-group">
                    <label for="nama_penerima">Nama Penerima</label>
                    <input type="text" class="form-control" name="nama_pembeli">
                </div>
                <div class="form-group">
                    <label for="Kota">Kota</label>
                    <select name="nama_kota" id="nama_kota" class="form-control">
                        <option hidden>Pilih Kota</option>
                        <option value="Jakarta">Jakarta</option>
                        <option value="Aceh">Aceh</option>
                        <option value="Bali">Bali</option>
                        <option value="Bandung">Bandung</option>
                        <option value="Bojong Gede">Bojong Gede</option>
                        <option value="Medan">Medan</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="kode_pos">Kode Pos</label>
                    <input type="text" class="form-control" id="kode_pos" name="kode_pos">
                </div>
                <div class="form-group">
                    <label for="pengiriman">Pengiriman</label>
                    <select name="jenis_pengiriman" id="jenis_pengiriman" class="form-control">
                        <option hidden>Pilih Pengiriman</option>
                        <option value="Instant">Instant</option>
                        <option value="Medium">Medium</option>
                        <option value="Premium">Premium</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="pembayaran">Pembayaran</label>
                    <select name="jenis_pembayaran" id="jenis_pembayaran" class="form-control">
                        <option hidden>Pilih Pembayaran</option>
                        <option value="COD">COD</option>
                        <option value="Gopay">Gopay</option>
                        <option value="Ovo">Ovo</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <textarea name="alamat" id="alamat" cols="20" rows="0" class="form-control"></textarea>
                </div>

                <button type="submit" name="checkout" class="btn-checkout">Checkout</button>
            </form>
        </div>

        <div class="card-billings">
            <h3>Ringkasan</h3>
            <div class=" content-billings">
                <?php $totalBelanja = 0; ?>
                <?php foreach ($_SESSION["cart"] as $product_id => $result) : ?>

                    <?php $data = queryData("SELECT * FROM products WHERE id_migo = '$product_id'")[0];
                    $totalHarga =  $result * $data["harga"];
                    ?>
                    <div class="price-billings">
                        <span>
                            <p style=" width: 300px;white-space: nowrap;overflow: hidden;text-overflow: ellipsis"><?= $data["nama"]; ?></p> (<?= $result; ?> Produk)
                        </span>
                        <span>Rp <?= number_format($totalHarga); ?></span>

                    </div>
                    <hr style="margin-top: 20px;">
                    <?php $totalBelanja += $totalHarga; ?>
                <?php endforeach; ?>
                <div class="price-billings" style="font-weight: bold;">
                    <span>Total Bayar</span>
                    <span>Rp <?= number_format($totalBelanja); ?></span>
                </div>


            </div>
        </div>
    </div>
</div>