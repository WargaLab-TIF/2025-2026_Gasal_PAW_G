<?php
include 'koneksi.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Penjualan</title>
</head>
<body>
    <h1>Dashboard Penjualan</h1>
    
    <p>
        <a href="form_transaksi.php">Tambah Transaksi</a> | 
        <a href="form_transaksi_detail.php">Tambah Transaksi Detail</a>
    </p>

    <hr>

    <h2>Data Barang</h2>
    <table border="1" cellpadding="5" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Nama Supplier</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $query = "SELECT barang.id, barang.nama_barang, barang.harga, barang.stok, 
                      supplier.nama as nama_supplier 
                      FROM barang 
                      LEFT JOIN supplier ON barang.supplier_id = supplier.id 
                      ORDER BY barang.id";
            
            $result = mysqli_query($conn, $query);
            
            if (!$result) {
                echo "<tr><td colspan='7'>ERROR Query Barang: " . mysqli_error($conn) . "</td></tr>";
            } elseif (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>BRG-" . str_pad($row['id'], 3, '0', STR_PAD_LEFT) . "</td>";
                    echo "<td>" . htmlspecialchars($row['nama_barang']) . "</td>";
                    echo "<td>Rp " . number_format($row['harga'], 0, ',', '.') . "</td>";
                    echo "<td>" . $row['stok'] . "</td>";
                    echo "<td>" . htmlspecialchars($row['nama_supplier'] ?? 'N/A') . "</td>";
                    echo "<td>";
                    echo "<a href='hapus_barang.php?id=" . $row['id'] . "' onclick='return confirm(\"Apakah Anda yakin ingin menghapus data ini?\")'>Delete</a>";
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='7' align='center'>Tidak ada data barang</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <hr>

    <h2>Data Transaksi</h2>
    <table border="1" cellpadding="5" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>Waktu Transaksi</th>
                <th>Keterangan</th>
                <th>Total</th>
                <th>Nama Pelanggan</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $query = "SELECT transaksi.id, transaksi.waktu_transaksi, transaksi.keterangan, 
                      transaksi.total, pelanggan.nama as nama_pelanggan 
                      FROM transaksi 
                      LEFT JOIN pelanggan ON transaksi.pelanggan_id = pelanggan.id 
                      ORDER BY transaksi.id DESC";
            
            $result = mysqli_query($conn, $query);
            
            if (!$result) {
                echo "<tr><td colspan='5'>ERROR Query Transaksi: " . mysqli_error($conn) . "</td></tr>";
            } elseif (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . date('d/m/Y', strtotime($row['waktu_transaksi'])) . "</td>";
                    echo "<td>" . htmlspecialchars($row['keterangan']) . "</td>";
                    echo "<td>Rp " . number_format($row['total'], 0, ',', '.') . "</td>";
                    echo "<td>" . htmlspecialchars($row['nama_pelanggan'] ?? 'N/A') . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5' align='center'>Tidak ada data transaksi</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <hr>

    <h2>Data Detail Transaksi</h2>
    <table border="1" cellpadding="5" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Transaksi ID</th>
                <th>Nama Barang</th>
                <th>Harga</th>
                <th>Qty</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $query = "SELECT transaksi_detail.transaksi_id, transaksi_detail.harga, 
                      transaksi_detail.qty, barang.nama_barang 
                      FROM transaksi_detail 
                      INNER JOIN barang ON transaksi_detail.barang_id = barang.id 
                      ORDER BY transaksi_detail.transaksi_id, transaksi_detail.barang_id";
            
            $result = mysqli_query($conn, $query);
            
            if (!$result) {
                echo "<tr><td colspan='4'>ERROR Query Detail: " . mysqli_error($conn) . "</td></tr>";
            } elseif (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['transaksi_id'] . "</td>";
                    echo "<td>" . htmlspecialchars($row['nama_barang']) . "</td>";
                    echo "<td>Rp " . number_format($row['harga'], 0, ',', '.') . "</td>";
                    echo "<td>" . $row['qty'] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4' align='center'>Tidak ada data detail transaksi</td></tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>
<?php
mysqli_close($conn);
?>