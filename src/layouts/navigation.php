<nav class="nav">
    <div class="child-nav">
        <a href="index.php" class="nav-brand">Printer</a>
    </div>
    <div class="child-nav">
        <ul class="list-nav">
            <li class="item-nav">
            <li class="item-nav">
                <a href="Keranjang.php" class="nav-brand">Keranjang anda</a>
                <a href="pesanan.php" class="nav-brand" style="margin-left: 10px;"><b>Pesanan anda </b></a>
            </li>
        </ul>
    </div>
    <div class="child-nav">
        <?php if (isset($_SESSION["signin"])) : ?>
            <ul class="list-nav">

                <li class="item-nav">
                    <a href="logout.php" class="nav-brand-auth-masuk">Logout</a>
                </li>
                <li class="item-nav">
                    <h3><?= $_SESSION["username"]; ?> <small>(<?= $_SESSION["level"]; ?>)</small></h3>
                </li>
            </ul>
        <?php endif; ?>
        <?php if (!isset($_SESSION["signin"])) : ?>
            <ul class="list-nav">
                <li class="item-nav">
                    Keranjang: <span id="count-cart"></span>
                </li>
                <li class="item-nav">
                    <a href="signin.php" class="nav-brand-auth-masuk">Masuk</a>
                </li>
                <li class="item-nav">
                    <a href="signup.php" class="nav-brand-auth-masuk">Daftar</a>
                </li>
            </ul>
        <?php endif; ?>
    </div>
</nav>