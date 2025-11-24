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

if (empty($args)) {
    header("location: login.php"); 
    exit;
}

$user_id = $args[0]['id_user']; 

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action'])) {
    $action = $_POST['action'];

    if ($action == 'create') {
        $pelanggan_id = $_POST['pelanggan_id'];
        $keterangan = $_POST['keterangan'];
        $barang_id = $_POST['barang_id'];
        $qty = (int)$_POST['qty'];
        $harga_jual = (int)$_POST['harga_jual'];
        $total_transaksi = $qty * $harga_jual;
        
        mysqli_begin_transaction($conn);

        try {
            $waktu_transaksi = date("Y-m-d");
            $stmt_trans = $conn->prepare("INSERT INTO transaksi (waktu_transaksi, keterangan, total, pelanggan_id, user_id) VALUES (?, ?, ?, ?, ?)");
            $stmt_trans->bind_param("ssisi", $waktu_transaksi, $keterangan, $total_transaksi, $pelanggan_id, $user_id);
            $stmt_trans->execute();
            $transaksi_id = $conn->insert_id;
            $stmt_trans->close();

            $stmt_detail = $conn->prepare("INSERT INTO transaksi_detail (transaksi_id, barang_id, harga, qty) VALUES (?, ?, ?, ?)");
            $stmt_detail->bind_param("iiii", $transaksi_id, $barang_id, $harga_jual, $qty);
            $stmt_detail->execute();
            $stmt_detail->close();
            $stmt_stok = $conn->prepare("UPDATE barang SET stok = stok - ? WHERE id = ?");
            $stmt_stok->bind_param("ii", $qty, $barang_id);
            $stmt_stok->execute();
            
            if ($stmt_stok->affected_rows === 0) {
                 throw new Exception("Gagal mengurangi stok atau barang tidak ditemukan.");
            }
            $stmt_stok->close();

            mysqli_commit($conn);
            header("location: transaksi.php?status=sukses_transaksi&id=" . $transaksi_id);
            exit;

        } catch (Exception $e) {
            mysqli_rollback($conn);
            header("location: transaksi_baru.php?status=gagal_transaksi&error=" . urlencode("Transaksi gagal: " . $e->getMessage()));
            exit;
        }
        
    } elseif ($action == 'delete') {
        $transaksi_id = (int)$_POST['id'];

        mysqli_begin_transaction($conn);
        
        try {
            $stmt_get_detail = $conn->prepare("SELECT barang_id, qty FROM transaksi_detail WHERE transaksi_id = ?");
            $stmt_get_detail->bind_param("i", $transaksi_id);
            $stmt_get_detail->execute();
            $result_detail = $stmt_get_detail->get_result();
            $details_to_restore = $result_detail->fetch_all(MYSQLI_ASSOC);
            $stmt_get_detail->close();

            $stmt_restore = $conn->prepare("UPDATE barang SET stok = stok + ? WHERE id = ?");
            foreach ($details_to_restore as $detail) {
                $stmt_restore->bind_param("ii", $detail['qty'], $detail['barang_id']);
                $stmt_restore->execute();
            }
            $stmt_restore->close();
            
            $stmt_del_detail = $conn->prepare("DELETE FROM transaksi_detail WHERE transaksi_id = ?");
            $stmt_del_detail->bind_param("i", $transaksi_id);
            $stmt_del_detail->execute();
            $stmt_del_detail->close();

            $stmt_del_trans = $conn->prepare("DELETE FROM transaksi WHERE id = ?");
            $stmt_del_trans->bind_param("i", $transaksi_id);
            $stmt_del_trans->execute();
            $stmt_del_trans->close();

            mysqli_commit($conn);
            header("location: transaksi.php?status=sukses_hapus");
            exit;

        } catch (Exception $e) {
            mysqli_rollback($conn);
            header("location: transaksi.php?status=gagal_hapus&error=" . urlencode("Gagal menghapus transaksi: " . $e->getMessage()));
            exit;
        }
    }
}

header("location: transaksi.php");
exit;
?>