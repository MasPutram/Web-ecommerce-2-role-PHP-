<?php

require "session.php";
require "koneksi.php";

$query = mysqli_query($con, "SELECT a.*, b.nama AS nama_kategori FROM produk a JOIN kategori b ON a. kategori_id = b.id");
$jumlahProduk = mysqli_num_rows($query);

$queryKategori = mysqli_query($con, "SELECT * FROM kategori");

function generateRandomString($length = 10)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../css/admin.css">
</head>

<style>
    .no-decoration {
        text-decoration: none;
        color: none;
    }

    form div {
        margin-bottom: 10px;
    }
</style>

<body>
    <?php require "navbar.php"; ?>
    
    <div class="container mt-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                    <a href="index.php" class="no-decoration text-muted">
                        <i class="bi-house-door-fill"></i> Home
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    Produk
                </li>
            </ol>
        </nav>

        <div class="mt-3 mb-5">
            <h2>List Produk</h2>

            <div class="table-responsive"></div>
            <table class="table mt-5">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th>Ketersediaan Stok</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($jumlahProduk == 0) {
                    ?>
                        <tr>
                            <td colspan=6 class="text-center">Produk tidak tersedia</td>
                        </tr>
                        <?php
                    } else {
                        $jumlah = 1;
                        while ($data = mysqli_fetch_array($query)) {
                        ?>
                            <tr>
                                <td><?php echo $jumlah; ?></td>
                                <td><?php echo $data['nama']; ?></td>
                                <td><?php echo $data['nama_kategori']; ?></td>
                                <td><?php echo $data['harga']; ?></td>
                                <td><?php echo $data['ketersediaan_stok']; ?></td>
                                <td>
                                    <a href="produk-detail.php?q=<?php echo $data['id'] ?>" class="btn btn-info"><i class="bi bi-search"></i></a>
                                </td>
                            </tr>
                    <?php
                            $jumlah++;
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <!-- tambah produk -->
        <div class="my-5 col-12 col-md-6"></div>
        <h3>Tambah Produk</h3>

        <form action="" method="post" enctype="multipart/form-data">
            <div>
                <label for="nama">Nama</label>
                <input type="text " id="nama" name="nama" class="form-control" autocomplete="off" required>
            </div>
            <div>
                <label for="kategori">Kategori</label>
                <select name="kategori" id="kategori" class="form-control" required>
                    <option value="">pilih satu</option>
                    <?php
                    while ($data = mysqli_fetch_array($queryKategori)) {
                    ?>
                        <option value="<?php echo $data['id'] ?>"> <?php echo $data['nama'] ?>
                        </option>
                    <?php
                    }
                    ?>
                </select>
            </div>
            <div>
                <label for="harga">Harga</label>
                <input type="number" class="form-control" name="harga" autocomplete="off" required>
            </div>



            <label for="foto">Foto Produk</label>



            <div>
                <input type="file" name="foto" id="foto" class="form-control">
            </div>
            <div>
                <label for="detail">Detail</label>
                <textarea name="detail" id="detail" cols="30" rows="10" class="form-control"></textarea>
            </div>
            <div>
                <label for="ketersediaan_stok">Ketersediaan Stok</label>
                <select name="ketersediaan_stok" id="ketersediaan_stok" class="form-control">
                    <option value="tersedia">tersedia</option>

                    <option value="habis">habis</option>
                </select>
            </div>
            <div>
                <button type="submit" class="btn btn-primary mb-5" name="simpan">Simpan</button>
            </div>
        </form>

        <?php
        if (isset($_POST['simpan'])) {
            $nama = htmlspecialchars($_POST['nama']);
            $kategori = htmlspecialchars($_POST['kategori']);
            $harga = htmlspecialchars($_POST['harga']);
            $detail = htmlspecialchars($_POST['detail']);
            $ketersediaan_stok = htmlspecialchars($_POST['ketersediaan_stok']);

            $target_dir = "../image/";
            $nama_file = basename($_FILES["foto"]["name"]);
            $target_file = $target_dir . $nama_file;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            $image_size = $_FILES["foto"]["size"];
            $random_name = generateRandomString(10);
            $new_name = $random_name . "." . $imageFileType;

            if ($nama == '' || $kategori == '' || $harga == '') {

        ?>
                <div class="alert alert-danger" role="alert">
                    Nama , Harga , Kategori harus di isi!
                </div>
                <?php
            } else {
                if ($nama_file != '') {
                    if ($image_size > 1000000) {
                ?>
                        <div class="alert alert-warning mt-3" role="alert">
                            File tidak boleh lebih dari 1 mb
                        </div>
                        <?php
                    } else {
                        if ($imageFileType != 'jpg' && $imageFileType  != 'png' && $imageFileType != 'jpeg') {
                        ?>
                            <div class="alert alert-warning mt-3" role="alert">
                                File wajib bertipe jpg atau png atau gif
                            </div>
                    <?php
                        } else {
                            move_uploaded_file($_FILES["foto"]["tmp_name"], $target_dir . $new_name);
                        }
                    }
                }

                // query insert to produk table
                $queryTambah = mysqli_query($con, "INSERT INTO produk (kategori_id , nama , harga , foto , detail, ketersediaan_stok) VALUES ('$kategori', '$nama' , '$harga', '$new_name', '$detail' , '$ketersediaan_stok')");

                if ($queryTambah) {
                    ?>
                    <div class="alert alert-warning mt-3" role="alert">
                        Produk Berhasil Tersimpan
                    </div>

                    <meta http-equiv="refresh" content="2; url=produk.php" />
        <?php
                } else {
                    echo mysqli_error($con);
                }
            }
        }
        ?>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>