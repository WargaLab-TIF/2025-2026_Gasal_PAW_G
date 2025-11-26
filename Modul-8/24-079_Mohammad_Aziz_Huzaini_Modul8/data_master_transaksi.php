<?php
session_start();
include 'koneksi.php';
if(!isset($_SESSION['login'])){ header('Location: login.php'); exit; }

$query = "SELECT t.id, t.waktu_transaksi, t.keterangan, t.total, p.nama AS nama_pelanggan FROM transaksi t LEFT JOIN pelanggan p ON t.pelanggan_id = p.id ORDER BY t.waktu_transaksi DESC";
$result = mysqli_query($conn, $query);
$transaksi_data = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html>

<body>
    <h2>Data Master Transaksi</h2>
    <div style='text-align:right'>
        <a href="index.php">< Kembali</a>
        <button onclick="location.href='report_transaksi.php'">Lihat Laporan</button> 
        <button onclick="location.href='tambah_transaksi.php'">Tambah Transaksi</button>
        <button onclick="location.href='form_transaksi_detail.php'">Tambah Transaksi Detail</button>
    </div>
    <br><br>
    <table border='1' cellpadding='6' cellspacing='0'>
        <thead>
            <tr>
                <th>No</th>
                <th>ID Transaksi</th>
                <th>Waktu Transaksi</th>
                <th>Nama Pelanggan</th>
                <th>Keterangan</th>
                <th>Total</th>
                <th>Tindakan</th>
            </tr>
        </thead>
        <tbody>
            <?php if(count($transaksi_data)>0){ $no=1; foreach($transaksi_data as $t){ echo "<tr>"; echo "<td>{$no}</td>"; echo "<td>{$t['id']}</td>"; echo "<td>{$t['waktu_transaksi']}</td>"; echo "<td>{$t['nama_pelanggan']}</td>"; echo "<td>{$t['keterangan']}</td>"; echo "<td>Rp ".number_format($t['total'],0,',','.')."</td>"; echo "<td><a href='lihat_transaksi.php?id={$t['id']}'>Lihat Detail</a> | <a href='hapus_transaksi.php?id={$t['id']}' onclick=\"return confirm('Hapus transaksi?')\">Hapus</a></td>"; echo "</tr>"; $no++; } } else { echo "<tr><td colspan='7'>Tidak ada data transaksi</td></tr>"; } ?>
        </tbody>
    </table>
</body>

</html>