<?php
$host = "localhost";
$username = "root";
$password = "";
$database   = "store"; 

$conn = mysqli_connect($host, $username, $password, $database);

if (!$conn) {
    echo "Koneksi gagal: " . mysqli_connect_error();
}

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "DELETE FROM supplier WHERE id = $id";
    if (mysqli_query($conn, $sql)) {
        header("Location: supplier.php");
        exit;
    } else {
        echo "Gagal menghapus data: ";
    }
} else {
    echo "ID tidak ditemukan.";
}
?>
