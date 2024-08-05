<?php

require "../adminpanel/koneksi.php";

$queryKategori = mysqli_query($con, "SELECT * FROM kategori");

//search product by keyword

if (isset($_GET['keyword'])) {
    $queryProduk = mysqli_query($con, "SELECT * FROM produk WHERE nama LIKE '%$_GET[keyword]%'");
}

//search product by kategori

elseif (isset($_GET['kategori'])) {
    $queryGetKategoriId = mysqli_query($con, "SELECT id FROM kategori WHERE nama='$_GET[kategori]'");
    $kategoriId = mysqli_fetch_array($queryGetKategoriId);

    $queryProduk = mysqli_query($con, "SELECT * FROM produk WHERE kategori_id='$kategoriId[id]'");
}

//search product default

else {
    $queryProduk = mysqli_query($con, "SELECT * FROM produk");
}

$counData = mysqli_num_rows($queryProduk);

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hana | Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="footer.css">
</head>

<body>
    <!-- Navbar -->
    <?php require "navbar2.php"; ?>

    <!--judul slide img-->
    <div class=" container-fluid py-4 mt-5">
        <div class="container col-lg-7 col-md-10">
            <h4>BEST SELLING PRODUCT</h4>
        </div>
    </div>

    <!--slide img-->
    <?php require "../tampil/slideImg.php"; ?>

    <!--kotak-->
    <div class="container py-5">

        <!--list kategori-->
        <div class="row">
            <div class="col-lg-3 mb-5">
                <h4>CATEGORY</h4>
                <ul class="list-group">
                    <?php while ($kategori = mysqli_fetch_array($queryKategori)) { ?>
                        <a href="produk.php?kategori=<?php echo $kategori['nama'] ?>" class="no-decoration">
                            <li class="list-group-item"><?php echo $kategori['nama'] ?></li>
                        </a>
                    <?php } ?>
                </ul>
            </div>

            <!--list produk-->
            <div class="col-lg-9">
                <h4 class="text-center mb-3">PRODUCT</h4>
                <div class="row">
                    <?php
                    if ($counData < 1) {
                    ?>
                        <h6 class="text-center my-5">Produk Tidak Tersedia</h6>
                    <?php
                    }

                    ?>


                    <?php while ($produk = mysqli_fetch_array($queryProduk)) { ?>
                        <div class="col-md-4 col-sm-6 col-12 mb-4">
                            <div class="card kartu h-100">
                                <div class="image-box">
                                    <img src="../image/<?php echo $produk['foto'] ?>" class="card-img-top" alt="...">
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $produk['nama'] ?></h5>
                                    <p class="card-text text-truncate"><?php echo $produk['detail'] ?></p>
                                    <p class="card-text text-truncate">Rp <?php echo $produk['harga'] ?>/pcs</p>
                                    <a href="produk-detail.php?nama=<?php echo $produk['nama'] ?>" class="btn warna3 text-light">Details</a>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>

    <!--footer-->
    <?php require "../tampil/footer.php"; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>