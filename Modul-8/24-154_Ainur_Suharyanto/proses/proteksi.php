<?php
session_start();

// Jika belum login → wajib login
if (!isset($_SESSION['login'])) {
    header("Location: /tp8/proses/login.php");
    exit;
}

// Jika login tapi bukan user valid → amankan
if (!isset($_SESSION['level']) || !isset($_SESSION['nama'])) {
    header("Location: /tp8/proses/login.php");
    exit;
}
?>
