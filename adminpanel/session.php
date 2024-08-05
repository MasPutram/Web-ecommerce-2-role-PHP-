<?php
session_start();
if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
    header('Location: ../form/login.php');
    exit;
}

// Tambahkan validasi level user
if ($_SESSION['role'] !== 'admin') {
    header('Location: ../form/unauthorized.php');
    exit;
}
