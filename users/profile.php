<?php

session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: ../form/login.php');
    exit();
}

// Koneksi ke database
require "../adminpanel/koneksi.php";

// Ambil data pengguna dari database berdasarkan ID yang disimpan di session
$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM users WHERE id = $user_id";
$result = mysqli_query($con, $query);
$user = mysqli_fetch_assoc($result);


$queryOrder = mysqli_query($con, "SELECT * FROM ordered WHERE user_id = '$user_id'");


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HANA | Profile</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="footer.css">
</head>

<body>
    <?php require "navbar2.php" ?>

    <div class="container-fluid py-2 mt-5 ">
        <div class="container mt-5 ">
            <div class="mt-5 px-3" style="width: 30vh;">
                <img src="../image/user/user.png" class="card-img-top" alt="...">
                <div class="card-body mt-2 text-center">
                    <h5 class="card-title"><?php echo $user['username']; ?></h5>
                    <p class="card-text"><?php echo $user['email']; ?></p>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid py-3">
        <div class="container mt-3 mb-3">
            <h4>List Order</h4>
            <div class="table-responsive">
                <table id="example" class="table table-striped mb-3 " style="width:100%">
                    <thead>
                        <tr>
                            <td>Nama</td>
                            <td>Addres</td>
                            <td>Product</td>
                            <td>Quantity</td>
                            <td>Amount</td>
                            <td>Payment</td>
                            <td name="status">Status</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (mysqli_num_rows($queryOrder) > 0) {
                            while ($row = mysqli_fetch_array($queryOrder)) {
                                $namaProduk = $row['product']; // Ambil nama produk dari tabel order
                                $queryProduk = "SELECT harga FROM produk WHERE nama='$namaProduk'";
                                $produk = mysqli_query($con, $queryProduk);
                                $produkData = mysqli_fetch_assoc($produk);

                                if ($produkData) {
                                    $harga = floatval($produkData['harga']); // Konversi ke float
                                    $jumlah = intval($row['quantity']); // Konversi ke integer
                                    $total_harga = $harga * $jumlah;

                                    echo "<tr>
                <td>" . $row['nama'] . "</td>
                <td>" . $row['addres'] . "</td>
                <td>" . $row['product'] . "</td>
                <td>" . $row['quantity'] . "</td>
                <td>" . "Rp." . number_format($total_harga, 2) . "</td>
                <td>" . $row['payment'] . "</td>
                <td>" . $row['status'] . "</td>
            </tr>";
                                } else {
                                    echo "<tr>
                <td colspan='7'>Data produk tidak ditemukan.</td>
            </tr>";
                                }
                            }
                        } else {
                            echo "<tr>
        <td colspan='7' class='text-center'>Tidak ada produk yang dipesan.</td>
    </tr>";
                        }
                        ?>


                    </tbody>
                </table>
            </div>
            <?php if (mysqli_num_rows($queryOrder) > 0) { ?>
                <a href="https://wa.me/+6289665632320" class="btn warna3 text-light mt-3">BAYAR SEKARANG</a>
            <?php } ?>
        </div>
    </div>


    <?php require "../tampil/footer.php"; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>