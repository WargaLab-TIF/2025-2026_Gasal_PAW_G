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
        $nama = $_POST['nama'];
        $telp = $_POST['telp'];
        $alamat = $_POST['alamat'];

        $stmt = $conn->prepare("INSERT INTO supplier (nama, telp, alamat) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $nama, $telp, $alamat);

        if ($stmt->execute()) {
            header("location: master_supplier.php?status=sukses_tambah");
        } else {
            header("location: master_supplier.php?status=gagal_tambah&error=" . urlencode($stmt->error));
        }
        $stmt->close();
        
    } elseif ($action == 'update') {
        $id = $_POST['id'];
        $nama = $_POST['nama'];
        $telp = $_POST['telp'];
        $alamat = $_POST['alamat'];

        $stmt = $conn->prepare("UPDATE supplier SET nama=?, telp=?, alamat=? WHERE id=?");
        $stmt->bind_param("sssi", $nama, $telp, $alamat, $id);
        
        if ($stmt->execute()) {
            header("location: master_supplier.php?status=sukses_ubah");
        } else {
            header("location: master_supplier.php?status=gagal_ubah&error=" . urlencode($stmt->error));
        }
        $stmt->close();

    } elseif ($action == 'delete') {
        $id = $_POST['id'];

        $stmt_check = $conn->prepare("SELECT COUNT(*) FROM barang WHERE supplier_id = ?");
        $stmt_check->bind_param("i", $id);
        $stmt_check->execute();
        $stmt_check->bind_result($count);
        $stmt_check->fetch();
        $stmt_check->close();

        if ($count > 0) {
            header("location: master_supplier.php?status=gagal_hapus&error=" . urlencode("Supplier masih terhubung dengan $count barang."));
            exit;
        }

        $stmt = $conn->prepare("DELETE FROM supplier WHERE id = ?");
        $stmt->bind_param("i", $id);
        
        if ($stmt->execute()) {
            header("location: master_supplier.php?status=sukses_hapus");
        } else {
            header("location: master_supplier.php?status=gagal_hapus&error=" . urlencode($stmt->error));
        }
        $stmt->close();
    }
}

header("location: master_supplier.php");
exit;
?>