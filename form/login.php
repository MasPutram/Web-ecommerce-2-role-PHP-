<?php
session_start();
require "../adminpanel/koneksi.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hana | Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/admin.css">
</head>

<body>


    <div class="container main">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-3">
                <div class="icon-logo d-flex justify-content-center">
                    <img src="../image/page/Logo.jpg" alt="Logo">
                </div>
            </div>
            <div class="col-md-6">
                <div class="box-login ">
                    <div class="shadow p-5" style="width: 400px;">
                        <form action="" method="post">
                            <h2 class="text-center">LOGIN</h2>
                            <div class="form-group mt-4">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" name="username" id="username" autocomplete="off" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="password">Password</label>
                                <input type="text" class="form-control" name="password" id="password" autocomplete="off" required>
                            </div>
                            <button class="btn btn-primary form-control" type="submit" name="loginbtn">Login</button>
                        </form>
                        <div class="mt-2">
                            <p>Tidak Punya Akun? <a href="register.php">Register</a></p>
                        </div>
                    </div>

                    <div class="mt-3" style="width: 41vh;">
                        <?php

                        if (isset($_POST['loginbtn'])) {
                            $username = htmlspecialchars($_POST['username']);
                            $password = htmlspecialchars($_POST['password']);

                            $query = mysqli_query($con, "SELECT * FROM users WHERE username = '$username'");
                            $countdata = mysqli_num_rows($query);
                            $data = mysqli_fetch_array($query);

                            if ($countdata > 0) {
                                if (password_verify($password, $data['password'])) {
                                    $_SESSION['user_id'] = $data['id'];
                                    $_SESSION['username'] = $data['username'];
                                    $_SESSION['login'] = true;
                                    $_SESSION['role'] = $data['role'];

                                    if ($data['role'] == 'admin') {
                                        header('location: ../adminpanel/index.php');
                                    } else {
                                        header('location: ../index.php');
                                    }
                                    exit();
                                } else {
                                    echo '<div class="alert alert-danger" role="alert">Password salah.</div>';
                                }
                            } else {
                                echo '<div class="alert alert-danger" role="alert">Akun tidak ditemukan.</div>';
                            }
                        }
                        ?>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>