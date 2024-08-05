<?php
session_start();
require "../adminpanel/koneksi.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
                            <h2 class="text-center">REGISTER</h2>
                            <div class="form-group mt-4">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" name="username" id="username" autocomplete="off" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" name="email" id="email" autocomplete="off" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="password">Password</label>
                                <input type="text" class="form-control" name="password" id="password" autocomplete="off" required>
                            </div>
                            <button class="btn btn-primary form-control" type="submit" name="loginbtn">Register</button>
                        </form>
                        <div class="mt-2">
                            <p>Sudah Punya Akun? <a href="login.php">Login</a></p>
                        </div>
                    </div>

                    <div class="mt-3" style="width: 41vh;">
                        <?php

                        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                            $username = $_POST['username'];
                            $email = $_POST['email'];
                            $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

                            $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";
                            if (mysqli_query($con, $sql)) {
                        ?>
                                <script>
                                    alert("akun berhasil ditambahkan");
                                </script>
                                <div class="alert alert-warning mt-3" role="alert">
                                    Silahkan Login Kembali
                                </div>
                                <meta http-equiv="refresh" content="3; url=login.php" />
                        <?php } else {
                                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
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