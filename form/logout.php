<?php
session_start();

if (isset($_SESSION['role'])) {
    $role = $_SESSION['role'];
    session_unset();
    session_destroy();

    if ($role == 'admin') {
        header('Location: login.php'); // Admin diarahkan ke halaman login
    } else {
        header('Location: ../index.php'); // Member diarahkan ke halaman index
    }
} else {
    session_unset();
    session_destroy();
    header('Location: ../index.php');
}

exit();
?>
