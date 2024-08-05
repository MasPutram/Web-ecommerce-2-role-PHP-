<?php

require "../adminpanel/koneksi.php";

$queryOrder = mysqli_query($con, "SELECT * FROM ordered");

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

    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="footer.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>
    <?php require "navbar2.php" ?>

    <div class="container-fluid py-5">
        <div class="container mt-5">
            <table id="example" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <td>Nama</td>
                        <td>Addres</td>
                        <td>Product</td>
                        <td>Quantity</td>
                        <td>Payment</td>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_array($queryOrder)) {
                        echo "<tr>
        <td>" . $row['nama'] . "</td>
        <td>" . $row['addres'] . "</td>
        <td>" . $row['product'] . "</td>
        <td>" . $row['quantity'] . "</td>
        <td>" . $row['payment'] . "</td>
        </tr>";
                    } ?>
                </tbody>
            </table>
        </div>
    </div>

    <?php require "../tampil/footer.php"; ?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap5.js"></script>
    <script src="https://cdn.datatables.net/responsive/3.0.2/js/dataTables.responsive.js"></script>
    <script src="https://cdn.datatables.net/responsive/3.0.2/js/responsive.bootstrap5.js"></script>

    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        });
    </script>
</body>

</html>