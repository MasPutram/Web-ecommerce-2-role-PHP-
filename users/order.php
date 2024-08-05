<?php

session_start();
if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
    echo "<script> 
            alert ('silahkan login terlebih dahulu.');
            window.location.href = 'index.php';
            </script>";
    exit;
}

require "../adminpanel/koneksi.php";
$id = $_GET['order'];

$query = mysqli_query($con, "SELECT a.*, b.nama AS nama_kategori FROM produk a JOIN kategori b ON a. kategori_id = b.id WHERE a. id='$id'");
$data = mysqli_fetch_array($query);

$queryKategori = mysqli_query($con, "SELECT * FROM kategori WHERE id!=$data[kategori_id]");

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="footer.css">
</head>

<style>
    form div {
        margin-bottom: 10px;
    }
</style>

<body>
    <?php require "navbar2.php"; ?>

    <div class="container-fluid py-5">
        <div class="container ">
            <div class="row justify-content-start align-items-center">
                <div class="col-md-3">
                    <h4 class="mb-5"><?php echo $data['nama'] ?></h4>
                    <p><?php echo $data['detail'] ?></p>
                    <p>Kategori : <?php echo $data['nama_kategori'] ?></p>
                    <p class="text-harga">
                        Harga : Rp <?php echo $data['harga'] ?>/pcs</p>
                    <p>Ketersediaan Stok : <strong><?php echo $data['ketersediaan_stok'] ?></strong></p>
                </div>
                <div class="col-md-3 image-box">
                    <img src="../image/<?php echo $data['foto'] ?>" class="card-img-top" alt="...">
                </div>


            </div>
        </div>
    </div>

    <div class="container-fluid py-3">
        <div class="container mt-3 mb-5">


            <div class="row">
                <div class="col-6 col-md-6">
                    <form action="" method="post" enctype="multipart/form-data">
                        <h3>FORM ORDER</h3>
                        <div>
                            <label for="nama">Full Name</label>
                            <input type="text" id="nama" name="nama" value="" placeholder="your name" class="form-control" autocomplete="off" required>
                        </div>
                        <div>
                            <label for="email">Email</label>
                            <input type="text" id="email" name="email" value="" placeholder="ex.yoyo@gmail.com" class="form-control" required>
                        </div>
                        <div>
                            <label for="addres">Addres</label>
                            <input type="text" id="addres" name="addres" value="" placeholder="ex. Jakarta , jl. racing , dusun begal rt 01 rw 20" class="form-control" required>
                        </div>
                        <div>
                            <label for="number">Phone (WhatsApp)</label>
                            <input type="text" id="phone" name="phone" value="" placeholder="ex. 08123456789" class="form-control" required>
                        </div>
                        <div>
                            <label for="nama">Product</label>
                            <input type="text" id="product" name="product" value="<?php echo $data['nama'] ?>" class="form-control" readonly>
                        </div>
                        <div>
                            <label for="nama_kategori">Category</label>
                            <input type="text" id="category" name="category" value="<?php echo $data['nama_kategori'] ?>" class="form-control" readonly>
                        </div>
                        <div>
                            <label for="number">Order Quantity</label>
                            <input type="text" id="quantity" name="quantity" value="" placeholder="only number" class="form-control" required>
                            <p class="fst-italic" style="margin: 0; padding: 0;">minimal order 300pcs</p>
                        </div>
                        <div>
                            <label for="payment">Payment With</label>
                            <select name="payment" id="pay" class="form-select">
                                <option class="text-muted" selected>Open this select menu</option>
                                <option value="BRI">BRI</option>
                                <option value="MANDIRI">MANDIRI</option>
                                <option value="BCA">BCA</option>
                                <option value="DANA">DANA</option>
                                <option value="SHOPEE">SHOPEE</option>
                                <option value="GOPAY">GOPAY</option>
                            </select>
                        </div>
                        <div>
                            <button class="btn btn-primary px-5 mt-3" type="submit" name="simpan">
                                <i class="bi bi-cart"></i>
                                Checkout
                            </button>
                        </div>
                    </form>

                    <?php
                    if (session_status() == PHP_SESSION_NONE) {
                        session_start();
                    }

                    if (isset($_POST['simpan'])) {
                        if (!ctype_digit($_POST['phone'])) {
                    ?>
                            <div class="alert alert-warning mt-3" role="alert">
                                No telepon hanya berisi angka
                            </div>
                            <?php

                        } else {
                            $nama = htmlspecialchars($_POST['nama']);
                            $email = htmlspecialchars($_POST['email']);
                            $addres = htmlspecialchars($_POST['addres']);
                            $phone = htmlspecialchars($_POST['phone']);
                            $product = htmlspecialchars($_POST['product']);
                            $quantity = htmlspecialchars($_POST['quantity']);
                            $payment = htmlspecialchars($_POST['payment']);
                            $user_id = $_SESSION['user_id'];

                            // Setel zona waktu default ke Asia/Jakarta
                            date_default_timezone_set('Asia/Jakarta');
                            $tanggal = new DateTime();
                            $formatted_date = $tanggal->format('Y-m-d H:i:s');

                            $queryTambah = mysqli_query($con, "INSERT INTO ordered (nama, email, addres, phone, product, quantity, payment, tanggal, user_id) VALUES ('$nama', '$email', '$addres', '$phone', '$product', '$quantity', '$payment', '$formatted_date' , '$user_id')");

                            if ($queryTambah) {
                                $Order = mysqli_insert_id($con);
                            ?>
                                <div class="alert alert-warning mt-3" role="alert">
                                    Order dibuat
                                </div>
                                <meta http-equiv="refresh" content="2; url=profile.php" />
                    <?php
                            } else {
                                echo mysqli_error($con);
                            }
                        }
                    }
                    ?>
                </div>

                <!--Paymnent-->
                <?php require "../tampil/pay.php"; ?>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>