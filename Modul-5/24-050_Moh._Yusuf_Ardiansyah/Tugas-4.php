<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "store";
$conn = mysqli_connect($host, $user, $pass, $db);
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

if (!isset($_GET['id'])) {
    header("Location: Tugas-1.php");
    exit;
}

$id = (int) $_GET['id'];
$sql = "DELETE FROM supplier WHERE id = $id LIMIT 1";
if (mysqli_query($conn, $sql)) {
    header("Location: Tugas-1.php");
    exit;
} else {
    echo "Gagal menghapus data: " . mysqli_error($conn);
}
?>