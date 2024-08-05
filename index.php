<?php
require "adminpanel/koneksi.php";
$queryProduk = mysqli_query($con, "SELECT id, nama, harga, foto, detail FROM produk LIMIT 3");
?>

<!Doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Hana Undangan</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="users/style.css">
  <link rel="stylesheet" href="users/highlight.css">
  <link rel="stylesheet" href="users/footer.css">
</head>

<body>
  <?php
  if (session_status() == PHP_SESSION_NONE) {
    session_start();
  }
  ?>
  <nav class="navbar navi navbar-expand-lg fixed-top navbar-dark warna4 ">
    <div class="container">
      <a class="navbar-brand" href="index.php">HANA</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link " aria-current="page" href="index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="users/produk.php">Product</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="users/order2.php">Order</a>
          </li>
          <?php if (isset($_SESSION['login']) && $_SESSION['login'] === true) : ?>
            <li class="nav-item">
              <a class="nav-link" href="users/profile.php"><i class="bi bi-person-circle"></i> <?php echo $_SESSION['username']; ?></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="form/logout.php">Logout</a>
            </li>
          <?php else : ?>
            <li class="nav-item">
              <a class="nav-link" href="form/login.php"><i class="bi bi-person-circle"></i> Login</a>
            </li>
          <?php endif; ?>
        </ul>
        <form method="get" action="users/produk.php" class="d-flex">
          <input class="form-control me-2" type="search" placeholder="cari disini..." name="keyword" aria-label="Search" />
          <button class="btn outline warna2 " type="submit">Search</button>
        </form>
      </div>
    </div>
  </nav>



  <div class="container-fluid banner d-flex align-items-center">
    <div class="container text-center text-white">
      <h2>Welcome To Hana Undangan</h2>
      <h6>Lorem ipsum dolor sit amet consectetur adipisicing elit. Laborum, doloribus.</h6>
    </div>
  </div>


  <!--highlight-->
  <div class="container-fluid py-5">
    <div class="container text-center">
      <h3>New Product</h3>
      <p>lorem ipsum dolor sit amet</p>
      <div class="container d-flex ">
        <div class="cols-sm-2 cols-md-4 container1 container list">
          <div class="item">
            <img src="image/page/Hepi.jpg" alt="">
            <div class="content">
              <h1>imageNAme</h1>
              <div class="des">
                Lorem ipsum dolor sit, amet consectetur adipisicing elit. Laudantium rem neque excepturi cum
                porro recusandae! Consectetur architecto tempore facere? Odit dolore alias vero obcaecati
                atque
                ut aliquid recusandae voluptatem enim?
              </div>
            </div>
          </div>

          <div class="item">
            <img src="image/page/riski49.jpg" alt="">
            <div class="content">
              <h1>imageNAme</h1>
              <div class="des">
                Lorem ipsum dolor sit, amet consectetur adipisicing elit. Laudantium rem neque excepturi cum
                porro recusandae! Consectetur architecto tempore facere? Odit dolore alias vero obcaecati
                atque
                ut aliquid recusandae voluptatem enim?
              </div>
            </div>
          </div>

          <div class="item">
            <img src="image/page/jago78.jpg" alt="">
            <div class="content">
              <h1>imageNAme</h1>
              <div class="des">
                Lorem ipsum dolor sit, amet consectetur adipisicing elit. Laudantium rem neque excepturi cum
                porro recusandae! Consectetur architecto tempore facere? Odit dolore alias vero obcaecati
                atque
                ut aliquid recusandae voluptatem enim?
              </div>
            </div>
          </div>

          <div class="item">
            <img src="image/page/hepi23.jpg" alt="">
            <div class="content">
              <h1>imageNAme</h1>
              <div class="des">
                Lorem ipsum dolor sit, amet consectetur adipisicing elit. Laudantium rem neque excepturi cum
                porro recusandae! Consectetur architecto tempore facere? Odit dolore alias vero obcaecati
                atque
                ut aliquid recusandae voluptatem enim?
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!--About Us-->
  <div class="container-fluid py-5">
    <div class="container">
      <div class="text-center">
        <h3>About Us</h3>
      </div>
      <div class="container mb-3" style="max-width: 800px;">
        <div class="row g-0">
          <div class="col-md-4">
            <img src="../image/page/Logo.jpg" class="img-fluid rounded-start" alt="...">
          </div>
          <div class="col-md-8">
            <div class="card-body">
              <p class="card-text">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Nobis repudiandae excepturi
                ad
                nulla eos sapiente qui praesentium ipsam adipisci esse magni sequi vel, nemo nihil libero! Omnis, quam?
                Architecto, obcaecati delectus sunt dolorem aliquam magnam totam. Expedita iste quisquam cum dicta
                adipisci
                suscipit dolores minima temporibus iure? Cumque, voluptates nihil minima possimus, consectetur
                repellendus
                praesentium rem non minus molestiae aliquam voluptas? Blanditiis et, expedita dolores totam similique
                molestias? Molestiae, impedit!</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!--produk-->

  <div class="container mt-5">
    <div class="float-start">
      <h3>Product</h3>
    </div>
    <div class="float-end col-sm-3 col-md-2 mt-3">
      <p class="fs-6"><a href="produk.php" class="no-decoration"> SEE MORE >></a></p>
    </div>
  </div>

  <div class="container-fluid py-5">
    <div class="container text-center">
      <div class="row mt-3">
        <?php while ($data = mysqli_fetch_array($queryProduk)) { ?>
          <div class="col-sm-6 col-md-4 mb-3">
            <div class="card h-100">
              <div class="image-box">
                <img src="image/<?php echo $data['foto'] ?>" class="card-img-top" alt="...">
              </div>
              <div class="card-body">
                <h5 class="card-title"><?php echo $data['nama'] ?></h5>
                <p class="card-text text-truncate"><?php echo $data['detail'] ?></p>
                <p class="card-text text-truncate">Rp <?php echo $data['harga'] ?>/pcs</p>
                <a href="users/produk.php?=<?php echo $data['nama']; ?>" class="btn warna3 text-light">Details</a>
              </div>
            </div>
          </div>
        <?php } ?>
      </div>
    </div>
  </div>

  <!--footer-->
  <?php require "tampil/footer.php"; ?>



  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>