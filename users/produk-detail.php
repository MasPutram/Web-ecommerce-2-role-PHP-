<?php

require "../adminpanel/koneksi.php";

$nama = htmlspecialchars($_GET['nama']);


$queryProduk = mysqli_query($con, "SELECT * FROM produk WHERE nama='$nama'");
$produk = mysqli_fetch_array($queryProduk);


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product | Detail</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="footer.css">

</head>

<body>
    <!--navbar-->
    <?php require "navbar2.php"; ?>

    <div class="container-fluid py-5 ">
        <div class="container mt-5">
            <div class="row ">
                <div class="col-md-4 image-box">
                    <img src="../image/<?php echo $produk['foto'] ?>" class="card-img-top" alt="...">
                </div>

                <div class="col-md-6">
                    <h4 class="mb-5"><?php echo $produk['nama'] ?></h4>
                    <p><?php echo $produk['detail'] ?></p>
                    <p class="text-harga">
                        Harga : Rp <?php echo $produk['harga'] ?>/pcs</p>
                    <p>Ketersediaan Stok : <strong><?php echo $produk['ketersediaan_stok'] ?></strong></p>

                    <a href="order.php?order=<?php echo $produk['id'] ?>" class="buyDecor btn btn-primary px-4"><i class="bi bi-cart"></i>Purchase</a>

                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid py-3 warna3">
        <div class="container text-center">
            <h5>Relateds Product</h5>
        </div>
    </div>

    <!--footer-->
    <?php require "../tampil/footer.php"; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>