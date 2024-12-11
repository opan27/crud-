<?php
$dbconnect = mysqli_connect("localhost", "root", "", "migo");


function queryData($query)
{
    global $dbconnect;
    $data = mysqli_query($dbconnect, $query);
    $rows = [];

    while ($row = mysqli_fetch_assoc($data)) {
        $rows[] = $row;
    }
    return $rows;
}

function signup($data)
{

    global $dbconnect;
    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($dbconnect, $data["password"]);
    $email = htmlspecialchars($data["email"]);
    $no_telp = htmlspecialchars($data["no_telp"]);
    $umur = htmlspecialchars($data["umur"]);
    $query = "SELECT * FROM users WHERE username = '$username'";
    $resultNama =  mysqli_query($dbconnect, $query);


    if (mysqli_fetch_assoc($resultNama)) {
        echo "
        <script>
            alert('username sudah ada!');
        </script>
    ";
        return false;
    }


    if (empty($username)) {
        echo "Username tidak boleh kosong";
    } else if (empty($password)) {
        echo "Password tidak boleh kosong";
    } else if (empty($email)) {
        echo "Email tidak boleh kosong";
    } else if (empty($no_telp)) {
        echo "no telphone tidak boleh kosong";
    } else if (empty($umur)) {
        echo "umur tidak boleh kosong";
    }
    $password = password_hash($password, PASSWORD_DEFAULT);
    $query = "INSERT INTO users VALUES (id,'$username', '$password', '$level' 'pembeli')";
    mysqli_query($dbconnect, $query);
    return mysqli_affected_rows($dbconnect);
}
function createAdmin($data)
{

    global $dbconnect;
    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($dbconnect, $data["password"]);

    if (empty($username)) {
        echo "Username tidak boleh kosong";
    } else if (empty($password)) {
        echo "Password tidak boleh kosong";
    } else if (empty($email)) 
    $password = password_hash($password, PASSWORD_DEFAULT);
    $query = "INSERT INTO users VALUES (id,'$username', '$password','penjual')";
    mysqli_query($dbconnect, $query);
    return mysqli_affected_rows($dbconnect);
}

function createProduct($data)
{
    global $dbconnect;
    $nama = htmlspecialchars($data["nama"]);
    $harga = htmlspecialchars($data["harga"]);
    $image = uploadImage();
    $stock = htmlspecialchars($data["stock"]);
    $deskripsi = htmlspecialchars($data["deskripsi"]);

    if (!$image) {
        return false;
    }

    $product = "SELECT * FROM products WHERE nama = '$nama'";
    $getProduct =  mysqli_query($dbconnect, $product);

    if (mysqli_fetch_assoc($getProduct)) {
        echo "
            <script>
                alert('Maaf data sudah ditambahkan!');
            </script>
        ";
        return false;
    }

    $queryCreateProduct = "INSERT INTO products VALUES(id_migo,'$nama','$harga','$image','$stock','$deskripsi',createdAt)";



    mysqli_query($dbconnect, $queryCreateProduct);

    return mysqli_affected_rows($dbconnect);
}


function uploadImage()
{
    /**
     * $_FILES: punya beberapa syarat
     * 1. namafile
     * 2.ukuranFile
     * 3. error
     * 4. tmpName
     * 5. dll
     *  */

    $namaFileImage = $_FILES["gambar"]["name"];
    $ukuranFileImage = $_FILES["gambar"]["size"];
    $error = $_FILES["gambar"]["error"];
    $tmpName = $_FILES["gambar"]["tmp_name"];

    // ketika gambarnya(file form) nya kosong
    if ($error === 4) {
        echo "
            <script>
                alert('Format gambar tidak mendukung!');
            </script>
        ";
        return false;
    }

    // cek jenis file gambar, jenis file yang wajib adalah: jpg,jpeg,png
    $ekstensiImageValid = ["jpg", "png", "jpeg"];
    $ekstensiImage = explode('.', $namaFileImage); // yourfile.jpg => ["yourfile", "jpg"];
    $ekstensiImage = strtolower(end($ekstensiImage)); //yourfile.jpg

    if (!in_array($ekstensiImage, $ekstensiImageValid)) {
        echo "
            <script>
                alert('You uploaded is not type image!');
            </script>
        ";
        return false;
    }

    if ($ukuranFileImage > 1000000) {
        echo "
            <script>
                alert('Your Files is to long!');
            </script>
        ";
        return false;
    }

    // generate file unik use uniqid()
    $newFileImage = uniqid();
    $newFileImage .= '.';
    // 287398278duuy2qdyq.jpg
    $newFileImage .= $ekstensiImage;

    // ketika filenya berhasil lolos semua validasi
    move_uploaded_file($tmpName, '../assets/images/' . $newFileImage);
    return $newFileImage;
}

function editProduct($data)
{
    global $dbconnect;
    $id = $data["id_migo"];
    $nama = htmlspecialchars($data["nama"]);
    $harga = htmlspecialchars($data["harga"]);
    $stock = htmlspecialchars($data["stock"]);
    $deskripsi = htmlspecialchars($data["deskripsi"]);
    $gambarLama = htmlspecialchars($data["gambar"]);
    // tidak ada file yang di upload
    if ($_FILES["gambar"]["error"] === 4) {
        $gambar = $gambarLama;
    } else {
        $gambar = uploadImage();
    }

    $queryUpdateProduct = "UPDATE  products SET nama='$nama', harga='$harga', stock='$stock', deskripsi='$deskripsi', gambar='$gambar' WHERE id_migo = $id";

    mysqli_query($dbconnect, $queryUpdateProduct);
    return mysqli_affected_rows($dbconnect);
}

function deleteProduct($id)
{
    global $dbconnect;

    mysqli_query($dbconnect, "DELETE FROM products WHERE id_migo = $id");
    return mysqli_affected_rows($dbconnect);
}

function deleteCart($id)
{
    global $dbconnect;

    mysqli_query($dbconnect, "DELETE FROM products WHERE id_migo = $id");
    return mysqli_affected_rows($dbconnect);
}


function checkout($data)
{
    global $dbconnect;
    $nama_pembeli = $data["nama_pembeli"];
    $nama_kota = $data["nama_kota"];
    $kode_pos = $data["kode_pos"];
    $jenis_pengiriman = $data["jenis_pengiriman"];
    $jenis_pembayaran = $data["jenis_pembayaran"];
    $alamat = $data["alamat"];
    $waktuBelanja = date("Y-m-d h:m:s");

    $queryDataPembeli = "SELECT * FROM checkout WHERE nama_pembeli = '$nama_pembeli'";
    $resultPembeli = mysqli_query($dbconnect, $queryDataPembeli);
    if (mysqli_fetch_assoc($resultPembeli)) {
        echo "
            <script>
                alert('Maaf orderan sudah ada dengan nama tersebut!');
            </script>
        ";
        return false;
    }
    $queryCheckout = "INSERT INTO checkout VALUES(id_checkout,'$nama_pembeli','$nama_kota','$alamat','$kode_pos','$jenis_pengiriman','$jenis_pembayaran',status,'$waktuBelanja')";
    mysqli_query($dbconnect, $queryCheckout);

    unset($_SESSION['cart']);
    return mysqli_affected_rows($dbconnect);
}

function acceptOrder($id)
{
    global $dbconnect;
    $queryAccept = "UPDATE checkout SET status = 'accept' WHERE id_checkout = $id";
    mysqli_query($dbconnect, $queryAccept);
    return mysqli_affected_rows($dbconnect);
}

function rejectProduct($id)
{
    global $dbconnect;
    $queryReject = "UPDATE checkout SET status = 'reject' WHERE id_checkout = $id";
    mysqli_query($dbconnect, $queryReject);
    return mysqli_affected_rows($dbconnect);
}
