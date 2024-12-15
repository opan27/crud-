<?php
require('../app.php');

if (isset($_POST["signup"])) {
    if (signup($_POST) > 0) {
        echo "
        <script>
          alert('User Berhasil Ditambahkan!');
        document.location.href = 'signin.php';
        </script>
    ";
    }
} else if (isset($_POST["signupAdmin"])) {
    if (createAdmin($_POST) > 0) {
        echo "
            <script>
              alert('Admin Berhasil Ditambahkan!');
            document.location.href = 'signin.php';
            </script>
        ";
    }
} else {
    echo mysqli_error($dbconnect);
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="./assets/css/style_auth.css">

    <style>
        @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap");
        * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: "Poppins", sans-serif;
        }
        body {
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 10px;
        background: linear-gradient(135deg, #71b7e6, #9b59b6);
        }

        .card {
        max-width: 700px;
        width: 100%;
        background-color: #fff;
        padding: 25px 30px;
        border-radius: 5px;
        box-shadow: 0 5px 10px rgba(0, 0, 0, 0.15);
        }

        .card form {
        display: flex;
        flex-direction: column;
        flex-wrap: wrap;
        justify-content: space-between;
        margin: 20px 0 12px 0;
        }

        .card form .parent input{
        height: 45px;
        width: 100%;
        outline: none;
        font-size: 16px;
        border-radius: 5px;
        padding-left: 15px;
        border: 1px solid #ccc;
        border-bottom-width: 2px;
        transition: all 0.3s ease;
        }

        .card form .parent input:focus,
        .card form .parent input:valid{
            border-color: #9b59b6;
        }

        .card form .parent-btn {
            height: 45px;
            margin: 35px 0
        }

        .card form .parent-btn button{
            border-radius: 5px;
            border: none;
            color: #fff;
            font-size: 18px;
            font-weight: 500;
            letter-spacing: 1px;
            cursor: pointer;
            transition: all 0.3s ease;
            /* background: linear-gradient(135deg, #71b7e6, #9b59b6); */
        }
        .card form .parent-btn .btn-signup{
            background: #71b7e6;
        }
        .card form .parent-btn .btn-admin{
            border-radius: 5px;
            background: #9b59b6;
            border: none;
            padding: 8px 10px 8px 10px;
            cursor: pointer;
        }

        
    </style>

    <title>Sign Up</title>
</head>

<body>

    <div class="container">
        <div class="card">
            <h2 style="text-align: center;">Silahkan Daftar Terlebih Dahulu</h2>
            <??>
            <form action="" method="POST">
                <div class="parent">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" class="input-control">
                </div>
                <div class="parent">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" class="input-control">
                </div>
                <div class="parent-btn">
                    <button type="submit" name="signup" style="margin-left: 10px;" class="btn-signup">Sign Up</button>

                    <button type="submit" name="signupAdmin" style="margin-left: 10px; " id="btn-admin" class="btn-admin">Create Admin</button>
                    <p style="margin-top: 13px; margin-left: 20px;">Sudah punya akun? <a href="signin.php" style="text-decoration: none; color: blue;">Login disini</a></p>
                </div>
            </form>
        </div>
    </div>


    <script type="text/javascript">
        function adminFunc() {
            const btnAdmin = document.getElementById('btn-admin');
            if (btnAdmin.style.display === "block") {
                btnAdmin.style.display = "none";
            } else {
                btnAdmin.style.display = "block";
            }

        }
    </script>

</body>

</html>