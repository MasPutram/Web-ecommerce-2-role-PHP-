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

$queryProduk = mysqli_query($con, "SELECT * FROM produk");

$queryKategori = mysqli_query($con, "SELECT * FROM kategori");

$queryOrdered = mysqli_query($con, "SELECT * FROM ordered");
$order = mysqli_fetch_array($queryOrdered);


$produkArray = [];
while ($produk = mysqli_fetch_array($queryProduk)) {
    $produkArray[] = $produk;
}

$kategoriArray = [];
while ($kategori = mysqli_fetch_array($queryKategori)) {
    $kategoriArray[] = $kategori;
}
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
        <div class="container mt-3 mb-5">


            <div class="row">
                <div class="col-6 col-md-6 mt-3">
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
                            <input type="text" id="number" name="phone" value="" placeholder="ex. 08123456789" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="category">category</label>
                            <select name="category" id="category" class="form-control" onchange="updateProduct()">
                                <option class="text-muted" selected>Select this category</option>
                                <?php foreach ($kategoriArray as $kategori) { ?>
                                    <option value="<?php echo $kategori['id']; ?>">
                                        <?php echo $kategori['nama']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="product">Product</label>
                            <select name="product" id="product" class="form-control">
                                <option class="text-muted" selected>Select this product</option>
                            </select>
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
                                <a href="profile.php"></a>
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
                        } elseif ($_POST['category'] == 'Select this category' || $_POST['product'] == 'Select this product') {
                        ?>
                            <div class="alert alert-warning mt-3" role="alert">
                                Silahkan pilih produk yang anda inginkan
                            </div>
                        <?php
                        } elseif ($_POST['payment'] == 'Open this select menu') {
                        ?>
                            <div class="alert alert-warning mt-3" role="alert">
                                Metode pembayaran tidak boleh kosong
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

                                $idOrder = mysqli_insert_id($con);
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
                        

     <!--footer-->
     <?php require "../tampil/footer.php"; ?>

    <script>
        // Simpan semua produk dalam variabel JavaScript
        var produkArray = <?php echo json_encode($produkArray); ?>;

        function updateProduct() {
            var categoryId = document.getElementById("category").value;
            var productSelect = document.getElementById("product");

            // Hapus semua opsi produk
            productSelect.innerHTML = '<option value="">Pilih Produk</option>';

            // Filter produk berdasarkan kategori_id
            var hasProducts = false;
            for (var i = 0; i < produkArray.length; i++) {
                if (produkArray[i].kategori_id == categoryId) {
                    var option = document.createElement("option");
                    option.value = produkArray[i].nama;
                    option.text = produkArray[i].nama;
                    productSelect.add(option);
                    hasProducts = true;
                }
            }

            // Jika tidak ada produk untuk kategori yang dipilih
            if (!hasProducts) {
                var option = document.createElement("option");
                option.value = "";
                option.text = "Tidak ada produk untuk kategori ini";
                productSelect.add(option);
            }
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>


</body>

</html>