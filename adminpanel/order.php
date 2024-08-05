<?php

require "koneksi.php";

$queryOrder = mysqli_query($con, "SELECT * FROM ordered WHERE `status` = 'done'");
$queryUnpaid = mysqli_query($con, "SELECT * FROM ordered WHERE `status` = 'unpaid'");
$queryProcess = mysqli_query($con, "SELECT * FROM ordered WHERE `status` = 'process'");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HANA | MyOrder</title>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/v/bs5/dt-2.0.8/datatables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.0/css/dataTables.bootstrap5.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/3.0.2/css/responsive.bootstrap5.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../css/admin.css">
</head>

<body>
    <?php require "navbar.php" ?>

    <div class="container mt-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                    <a href="index.php" class="no-decoration text-muted">
                        <i class="bi-house-door-fill"></i> Home
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    Order List
                </li>
            </ol>
        </nav>
    </div>

    <!-- unpaid -->
    <div class="container-fluid py-2">
        <div class="container">
            <h4 class="mb-4">Status Unpaid</h4>
            <table id="unpaid" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <td>Nama</td>
                        <td>Addres</td>
                        <td>Phone</td>
                        <td>Product</td>
                        <td>Quantity</td>
                        <td>Status</td>
                        <td>Action</td>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($list = mysqli_fetch_array($queryUnpaid)) {
                        echo "<tr>
        <td>" . $list['nama'] . "</td>
        <td>" . $list['addres'] . "</td>
        <td>" . $list['phone'] . "</td>
        <td>" . $list['product'] . "</td>
        <td>" . $list['quantity'] . "</td>
        <td>" . $list['status'] . "</td>
        <td><a href='order-detail.php?id=" . $list['id'] . "' class='btn btn-warning'>Lihat Detail</a></td>
        </tr>";
                    } ?>
                </tbody>
            </table>
        </div>

        <!-- Process -->
        <div class="container-fluid py-2">
            <div class="container">
                <h4 class="mb-4">Status Process</h4>
                <table id="procces" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <td>Nama</td>
                            <td>Addres</td>
                            <td>Phone</td>
                            <td>Product</td>
                            <td>Quantity</td>
                            <td>Status</td>
                            <td>Action</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($list = mysqli_fetch_array($queryProcess)) {
                            echo "<tr>
        <td>" . $list['nama'] . "</td>
        <td>" . $list['addres'] . "</td>
        <td>" . $list['phone'] . "</td>
        <td>" . $list['product'] . "</td>
        <td>" . $list['quantity'] . "</td>
        <td>" . $list['status'] . "</td>
        <td><a href='order-detail.php?id=" . $list['id'] . "' class='btn btn-warning'>Lihat Detail</a></td>
        </tr>";
                        } ?>
                    </tbody>
                </table>
            </div>

            <!-- done order -->
            <div class="container-fluid py-2">
                <div class="container">
                    <h4 class="mb-4">Completed</h4>
                    <table id="example" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <td>Nama</td>
                                <td>Addres</td>
                                <td>Phone</td>
                                <td>Product</td>
                                <td>Quantity</td>
                                <td>Status</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = mysqli_fetch_array($queryOrder)) {
                                echo "<tr>
        <td>" . $row['nama'] . "</td>
        <td>" . $row['addres'] . "</td>
        <td>" . $row['phone'] . "</td>
        <td>" . $row['product'] . "</td>
        <td>" . $row['quantity'] . "</td>
        <td>" . $row['status'] . "</td>
        <td><a href='order-detail.php?id=" . $row['id'] . "' class='btn btn-warning'>Lihat Detail</a></td>
        </tr>";
                            } ?>
                        </tbody>
                    </table>
                </div>

                <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
                <script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
                <script src="https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap5.js"></script>
                <script src="https://cdn.datatables.net/responsive/3.0.2/js/dataTables.responsive.js"></script>
                <script src="https://cdn.datatables.net/responsive/3.0.2/js/responsive.bootstrap5.js"></script>

                <script>
                    $(document).ready(function() {
                        $('#example').DataTable({
                            responsive: true
                        });
                    });
                </script>
                <script>
                    $(document).ready(function() {
                        $('#unpaid').DataTable({
                            responsive: true
                        });
                    });
                </script>
                <script>
                    $(document).ready(function() {
                        $('#procces').DataTable({
                            responsive: true
                        });
                    });
                </script>
</body>

</html>