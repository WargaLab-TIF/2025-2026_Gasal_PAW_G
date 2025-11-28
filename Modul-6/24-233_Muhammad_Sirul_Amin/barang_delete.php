<?php
require 'db.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $id = intval($_POST['id'] ?? 0);
  if ($id) {
    $stmt = $mysqli->prepare("SELECT COUNT(*) AS cnt FROM transaksi_detail WHERE barang_id = ?");
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $cnt = $stmt->get_result()->fetch_assoc()['cnt'] ?? 0;
    if ($cnt > 0) {
      echo "<script>alert('Barang sudah digunakan dalam transaksi. Tidak bisa dihapus');location.href='index.php';</script>";
      exit;
    } else {
      $stmt2 = $mysqli->prepare("DELETE FROM barang WHERE id = ? LIMIT 1");
      $stmt2->bind_param('i', $id);
      $stmt2->execute();
    }
  }
}
header('Location: index.php'); exit;
