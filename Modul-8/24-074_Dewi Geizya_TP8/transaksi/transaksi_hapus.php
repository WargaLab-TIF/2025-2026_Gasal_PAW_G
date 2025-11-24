<?php
include '../auth.php'; 
require '../koneksi.php';

if ($_SESSION['user']['level'] != 1) {
    echo "Tidak punya akses";
    exit;
}

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($id > 0) {
    
    mysqli_begin_transaction($conn);
    try {
        $stmtD = mysqli_prepare($conn, 'DELETE FROM transaksi_detail WHERE transaksi_id = ?');
        mysqli_stmt_bind_param($stmtD, 'i', $id);
        mysqli_stmt_execute($stmtD);
        mysqli_stmt_close($stmtD);

        $stmtT = mysqli_prepare($conn, 'DELETE FROM transaksi WHERE id = ?');
        mysqli_stmt_bind_param($stmtT, 'i', $id);
        mysqli_stmt_execute($stmtT);
        mysqli_stmt_close($stmtT);

        mysqli_commit($conn);
    } catch (Exception $e) {
        mysqli_rollback($conn);
    }
}

header('Location: transaksi_index.php');
exit;
?>