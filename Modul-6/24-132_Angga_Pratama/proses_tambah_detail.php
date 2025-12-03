<?php
include 'koneksi.php';

$koneksi->begin_transaction();

try {
    if ($_SERVER["REQUEST_METHOD"] != "POST") {
        throw new Exception("Metode request tidak valid.");
    }

    $transaksi_id = $_POST['transaksi_id'];
    $barang_id = $_POST['barang_id'];
    $qty = $_POST['qty'];

    if (empty($transaksi_id) || empty($barang_id) || empty($qty) || $qty <= 0) {
        throw new Exception("Data tidak lengkap atau tidak valid.");
    }

    $stmt_check = $koneksi->prepare("SELECT barang_id FROM transaksi_detail WHERE transaksi_id = ? AND barang_id = ?");
    $stmt_check->bind_param("ii", $transaksi_id, $barang_id);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();
    
    if ($result_check->num_rows > 0) {
        throw new Exception("Barang yang dipilih sudah ada di detail transaksi ini.");
    }
    $stmt_check->close();

    $stmt_harga = $koneksi->prepare("SELECT harga FROM barang WHERE id = ?");
    $stmt_harga->bind_param("i", $barang_id);
    $stmt_harga->execute();
    $result_harga = $stmt_harga->get_result();
    
    if ($result_harga->num_rows == 0) {
        throw new Exception("Barang tidak ditemukan.");
    }
    $harga_satuan = $result_harga->fetch_assoc()['harga'];
    $stmt_harga->close();

    $total_harga_item = $harga_satuan * $qty;

    $stmt_insert = $koneksi->prepare("INSERT INTO transaksi_detail (transaksi_id, barang_id, harga, qty) VALUES (?, ?, ?, ?)");
    
    $stmt_insert->bind_param("iiii", $transaksi_id, $barang_id, $total_harga_item, $qty);
    
    if (!$stmt_insert->execute()) {
        throw new Exception("Gagal menyimpan detail transaksi: " . $stmt_insert->error);
    }
    $stmt_insert->close();

    $stmt_update = $koneksi->prepare(
        "UPDATE transaksi t
         SET t.total = (SELECT SUM(td.harga) 
                        FROM transaksi_detail td 
                        WHERE td.transaksi_id = ?)
         WHERE t.id = ?"
    );
    $stmt_update->bind_param("ii", $transaksi_id, $transaksi_id);
    
    if (!$stmt_update->execute()) {
        throw new Exception("Gagal memperbarui total transaksi: " . $stmt_update->error);
    }
    $stmt_update->close();

    $koneksi->commit();
    
    header("Location: index.php");
    exit();

} catch (Exception $e) {
    $koneksi->rollback();
    
    echo "<!DOCTYPE html><html><head><title>Error</title>";
    echo "<style>body { font-family: sans-serif; padding: 20px; } .error { color: red; border: 1px solid red; padding: 15px; border-radius: 5px; background: #ffeeee; } a { color: #007bff; }</style>";
    echo "</head><body>";
    echo "<div class='error'><strong>Error:</strong> " . $e->getMessage() . "</div>";
    echo "<br><a href='javascript:history.back()'>Kembali ke formulir</a>";
    echo "</body></html>";
}

$koneksi->close();
?>