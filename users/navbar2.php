<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<nav class="navbar navi navbar-expand-lg fixed-top navbar-dark warna4 ">
    <div class="container">
        <a class="navbar-brand" href="../index.php">HANA</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link " aria-current="page" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="produk.php">Product</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="order2.php">Order</a>
                </li>
                <?php if (isset($_SESSION['login']) && $_SESSION['login'] === true) : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="profile.php"><i class="bi bi-person-circle"></i> <?php echo $_SESSION['username']; ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../form/logout.php">Logout</a>
                    </li>
                <?php else : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="../form/login.php"><i class="bi bi-person-circle"></i> Login</a>
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

