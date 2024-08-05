<?php
session_start();
require "koneksi.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = mysqli_query($con, "SELECT * FROM ordered WHERE id = '$id'");
    $data = mysqli_fetch_array($query);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Order</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../css/admin.css">
</head>

<body>
    <?php require "navbar.php"; ?>

    <div class="container mt-3 mb-5">
        <h3>Detail Order</h3>
        <div class="col-12 col-md-6">
            <form action="" method="post" class="fs-6">
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $data['nama']; ?>">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?php echo $data['email']; ?>">
                </div>
                <div class="mb-3">
                    <label for="addres" class="form-label">Addres</label>
                    <input type="text" class="form-control" id="addres" name="addres" value="<?php echo $data['addres']; ?>">
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Phone</label>
                    <input type="text" class="form-control" id="phone" name="phone" value="<?php echo $data['phone']; ?>">
                </div>
                <div class="mb-3">
                    <label for="product" class="form-label">Product</label>
                    <input type="text" class="form-control" id="product" name="product" value="<?php echo $data['product']; ?>">
                </div>
                <div class="mb-3">
                    <label for="quantity" class="form-label">Quantity</label>
                    <input type="number" class="form-control" id="quantity" name="quantity" value="<?php echo $data['quantity']; ?>">
                </div>
                <div class="mb-3">
                    <label for="payment" class="form-label">Payment</label>
                    <input type="text" class="form-control" id="payment" name="payment" value="<?php echo $data['payment']; ?>">
                </div>
                <div>
                    <label for="Status">Status</label>
                    <select name="status" id="status" class="form-control">
                        <option value="<?php echo $data['status']; ?>">
                            <?php echo $data['status']; ?>
                        </option>

                        <?php
                        if ($data['status'] == 'unpaid') {
                        ?>
                            <option value="process">process</option>
                            <option value="done">done</option>
                        <?php
                        } elseif ($data['status'] == 'process') {
                        ?>
                            <option value="unpaid">unpaid</option>
                            <option value="done">done</option>
                        <?php
                        } else {
                        ?>
                            <option value="unpaid">unpaid</option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="tanggal" class="form-label">Tanggal</label>
                    <input type="text" class="form-control" id="tanggal" name="tanggal" value="<?php echo $data['tanggal']; ?>" readonly>
                </div>

                <div class="d-flex justify-content-between container">
                    <button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
                    <button type="submit" class="btn btn-danger" name="hapus">Hapus</button>
                </div>
            </form>
            <?php
            if (isset($_POST['simpan'])) {
                $nama = $_POST['nama'];
                $email = $_POST['email'];
                $addres = $_POST['addres'];
                $phone = $_POST['phone'];
                $product = $_POST['product'];
                $quantity = $_POST['quantity'];
                $payment = $_POST['payment'];
                $status = $_POST['status'];

                $updateQuery = "UPDATE ordered SET nama='$nama', email='$email', addres='$addres', phone='$phone', product='$product', quantity='$quantity', payment='$payment', status='$status' WHERE id='$id'";
                mysqli_query($con, $updateQuery);
                if ($updateQuery) {
            ?>
                    <div class="alert alert-success mt-3" role="alert">
                        Berhasil Update Produk
                    </div>

                    <meta http-equiv="refresh" content="2; url=order.php" />

                <?php

                }
            }

            if (isset($_POST['hapus'])) {

                $queryHapus = mysqli_query($con, "DELETE FROM ordered WHERE id='$id'");

                if ($queryHapus) {
                ?>
                    <div class="alert alert-success mt-3" role="alert">
                        Produk Dihapus
                    </div>

                    <meta http-equiv="refresh" content="1; url=order.php" />
            <?php
                }
            }
            ?>
        </div>
    </div>

</body>

</html>