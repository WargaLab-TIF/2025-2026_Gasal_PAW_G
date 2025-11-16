<?php
require __DIR__ . '/koneksi.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($id > 0) {
    // hapus detail dulu, lalu header transaksi
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

header('Location: transaksi.php');
exit;
