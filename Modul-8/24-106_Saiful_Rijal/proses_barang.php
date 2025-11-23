<?php
require_once "db.php";
require_once "auth.php"; 

$sql_user = "SELECT id_user, level FROM user WHERE username = ?";
$stmt_user = $conn->prepare($sql_user);
$stmt_user->bind_param("s", $_SESSION['username']);
$stmt_user->execute();
$result_user = $stmt_user->get_result();
$args = $result_user->fetch_all(MYSQLI_ASSOC);
$stmt_user->close();

if (empty($args) || $args[0]['level'] != '1') {
    header("location: index.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action'])) {
    $action = $_POST['action'];

    if ($action == 'create') {
        $nama_barang = $_POST['nama_barang'];
        $harga = $_POST['harga'];
        $stok = $_POST['stok'];
        $supplier_id = $_POST['supplier_id'];

        $stmt = $conn->prepare("INSERT INTO barang (nama_barang, harga, stok, supplier_id) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("siii", $nama_barang, $harga, $stok, $supplier_id);

        if ($stmt->execute()) {
            header("location: master_barang.php?status=sukses_tambah");
        } else {
            header("location: master_barang.php?status=gagal_tambah&error=" . urlencode($stmt->error));
        }
        $stmt->close();
        
    } elseif ($action == 'update') {
        // Logika Update menggunakan kolom 'id'
        $id_barang = $_POST['id'];
        $nama_barang = $_POST['nama_barang'];
        $harga = $_POST['harga'];
        $stok = $_POST['stok'];
        $supplier_id = $_POST['supplier_id'];

        $stmt = $conn->prepare("UPDATE barang SET nama_barang=?, harga=?, stok=?, supplier_id=? WHERE id=?");
        $stmt->bind_param("siiii", $nama_barang, $harga, $stok, $supplier_id, $id_barang);
        
        if ($stmt->execute()) {
            header("location: master_barang.php?status=sukses_ubah");
        } else {
            header("location: master_barang.php?status=gagal_ubah&error=" . urlencode($stmt->error));
        }
        $stmt->close();

    } elseif ($action == 'delete') {
        $id_barang = $_POST['id_barang'];

        $stmt = $conn->prepare("DELETE FROM barang WHERE id = ?");
        $stmt->bind_param("i", $id_barang);
        
        if ($stmt->execute()) {
            header("location: master_barang.php?status=sukses_hapus");
        } else {
            header("location: master_barang.php?status=gagal_hapus&error=" . urlencode($stmt->error));
        }
        $stmt->close();
    }
}

header("location: master_barang.php");
exit;
?>