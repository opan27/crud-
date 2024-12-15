<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Navbar</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Global reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
        }

        .nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #fff;
            padding: 10px 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .child-nav {
            display: flex;
            align-items: center;
        }

        .nav-brand {
            font-size: 22px;
            font-weight: 600;
            color: #333;
            text-decoration: none;
            padding: 0 10px;
        }

        .nav-right {
            margin-left: auto;
            display: flex;
            align-items: center;
            justify-content: flex-end;
        }

        #logo {
            color: #71b7e6;
        }

        .nav-brand:hover {
            color: #9b59b6;
        }

        .list-nav {
            list-style: none;
            display: flex;
            align-items: center;
        }

        .item-nav {
            margin-right: 15px;
        }

        .nav-brand-auth-masuk {
            font-size: 14px;
            color: #333;
            text-decoration: none;
            padding: 5px 10px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .nav-brand-auth-masuk:hover {
            background-color: #e74c3c;
            color: #fff;
        }

        h3 {
            font-size: 14px;
            color: #333;
        }

        #count-cart {
            font-weight: bold;
            color: #e74c3c;
        }

        /* Responsif: Menampilkan item menu secara vertikal pada layar kecil */
        @media (max-width: 768px) {
            .nav {
                flex-direction: column;
                align-items: flex-start;
            }

            .nav-right {
                display: flex;
                width: 100%;
                justify-content: flex-start;
                flex-direction: column;
            }

            .list-nav {
                flex-direction: column;
                width: 100%;
                display: flex;
                padding-left: 0;
            }

            .item-nav {
                margin: 10px 0;
                width: 100%;
                text-align: left;
            }

            .nav-right .item-nav a {
                width: 100%;
                padding: 10px;
                text-align: center;
            }
        }
    </style>
</head>
<body>
    <nav class="nav">
        <div class="child-nav">
            <a href="index.php" class="nav-brand" id="logo">Migo</a>
        </div>

        <div class="child-nav nav-right">
            <ul class="list-nav" id="nav-list">
                <li class="item-nav">
                    <a href="Keranjang.php" class="nav-brand"><i class="fas fa-shopping-cart"></i></a>
                    <a href="pesanan.php" class="nav-brand" style="margin-left: 10px;"><i class="fas fa-box"></i></a>
                </li>
            </ul>
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
</body>
</html>
