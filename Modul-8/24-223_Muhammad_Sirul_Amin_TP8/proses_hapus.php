<?php
include 'koneksi.php';

if (!isset($_SESSION['level']) || $_SESSION['level'] != 1) {
    header("Location: crud_user.php");
    exit();
}

if (isset($_GET['id'])) {
    $id_user = mysqli_real_escape_string($koneksi, $_GET['id']);
    
    if ($id_user == $_SESSION['id_user']) {
        header("Location: crud_user.php?status=gagal_hapus_diri");
        exit();
    }

    $query = "DELETE FROM user WHERE id_user='$id_user'";
    
    if (mysqli_query($koneksi, $query)) {
        header("Location: crud_user.php?status=sukses_hapus");
        exit();
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
} else {
    header("Location: crud_user.php");
    exit();
}
?>