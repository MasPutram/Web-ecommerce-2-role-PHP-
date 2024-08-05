<?php
    require "session.php";
    require "koneksi.php";

    if ($_SESSION['role'] !== 'admin') {
        header('Location: unauthorized.php');
        exit;
    }

    $queryKategori = mysqli_query($con, "SELECT * FROM kategori");
    $jumlahKategori = mysqli_num_rows($queryKategori);

    $queryProduk = mysqli_query($con, "SELECT * FROM produk");
    $jumlahProduk = mysqli_num_rows($queryProduk);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../css/admin.css">
</head>

<body>
    <?php require "navbar.php"; ?>
        <div class ="container mt-5">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">
                        <i class="bi-house-door-fill"></i> Home
                    </li>
                </ol>
            </nav>
                <h2>halo <?php echo $_SESSION['username']; ?></h2>
            <div class="container mt-5">
                <div class="row">
                    <div class ="col-lg-4 col-md-6 col-12 mb-3">
                        <div class="summary-kategori">
                            <div class="row">
                                <div class="col-6">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="160" height="160" fill="currentColor" class="bi bi-list" style=" color: #363636;" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5"/>
                                        </svg>
                                </div>
                            <div class="col-6 text-white p-3">
                                        <h3 class="fs-2">Kategori</h3>
                                        <p class="fs-4"><?php echo $jumlahKategori; ?> Kategori</p>
                                        <p ><a href="kategori.php" class="text-warning no-decoration ">Lihat Detail</a></p>
                                </div>
                            </div>
                        </div>    
                    </div>

                    <div class ="col-lg-5 col-md-6 col-12 mb-3">
                        <div class="summary-produk">
                            <div class="row">
                                <div class="col-6">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="130" height="130" fill="currentColor" class="bi bi-bookmark-heart"  style="color: #363636; margin-top: 18px; margin-left: 20px;" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M8 4.41c1.387-1.425 4.854 1.07 0 4.277C3.146 5.48 6.613 2.986 8 4.412z"/>
                                    <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.777.416L8 13.101l-5.223 2.815A.5.5 0 0 1 2 15.5zm2-1a1 1 0 0 0-1 1v12.566l4.723-2.482a.5.5 0 0 1 .554 0L13 14.566V2a1 1 0 0 0-1-1z"/>
                                    </svg>
                                </div>
                                <div class="col-6 text-white p-3">
                                        <h3 class="fs-2">Produk</h3>
                                        <p class="fs-4"><?php echo $jumlahProduk; ?> Produk</p>
                                        <p><a href="produk.php" class="text-warning no-decoration ">Lihat Detail</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>   
            </div>
        </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>