<?php
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: /tp8/proses/login.php");
    exit;
}

if (!isset($_SESSION['level']) || !isset($_SESSION['nama'])) {
    header("Location: /tp8/proses/login.php");
    exit;
}
?>
