<?php
// Pastikan path ini benar sesuai struktur folder Anda
include '../cek_session.php'; 
include '../koneksi.php'; 

// 1. Ambil input tanggal dari URL (dikirim dari laporan.php)
// Jika tidak ada, default ke hari ini
$start = isset($_GET['mulai']) ? $_GET['mulai'] : date('Y-m-d');
$end   = isset($_GET['selesai']) ? $_GET['selesai'] : date('Y-m-d');

// 2. Setup Header agar browser mengenali ini sebagai file Excel Download
$filename = "Laporan_Penjualan_" . $start . "_sd_" . $end . ".xls";
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=\"$filename\"");

// 3. Query SQL yang Benar (Sesuai Database Anda)
// - Mengambil dari tabel 'penjualan' (alias p)
// - JOIN ke tabel 'pelanggan' (alias pl) untuk dapat nama pelanggan
$sql = "SELECT p.*, pl.nama_pelanggan 
        FROM penjualan p 
        LEFT JOIN pelanggan pl ON p.id_pelanggan = pl.id_pelanggan 
        WHERE p.tanggal BETWEEN '$start' AND '$end' 
        ORDER BY p.tanggal ASC";

// 4. Eksekusi Query menggunakan variabel $koneksi
$result = mysqli_query($koneksi, $sql);

// Cek Error Query (Penting untuk debugging)
if (!$result) {
    die("<b>Error Database:</b> " . mysqli_error($koneksi));
}

// 5. Membuat Struktur Tabel HTML (Excel membaca HTML Table)
echo "<h3>Laporan Penjualan Periode $start s/d $end</h3>";
echo "
<table border='1' cellspacing='0' cellpadding='5'>
    <thead>
        <tr style='background-color:#007bff; color:white; font-weight:bold;'>
            <th width='40'>No</th>
            <th width='120'>Tanggal</th>
            <th width='200'>Nama Pelanggan</th>
            <th width='250'>Keterangan</th>
            <th width='150'>Total (Rp)</th>
        </tr>
    </thead>
    <tbody>
";

$no = 1;
$totalOmset = 0;

// Looping Data
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        // Penanganan jika data kosong/null
        $tgl_transaksi = date('d-m-Y', strtotime($row['tanggal']));
        $nama_pelanggan = !empty($row['nama_pelanggan']) ? $row['nama_pelanggan'] : 'Umum / Non-Member';
        
        // Cek kolom keterangan (jika Anda sudah menambahkannya ke DB)
        $keterangan = isset($row['keterangan']) ? $row['keterangan'] : '-';

        echo "
        <tr>
            <td align='center'>$no</td>
            <td align='center'>$tgl_transaksi</td>
            <td>$nama_pelanggan</td>
            <td>$keterangan</td>
            <td align='right'>" . number_format($row['total'], 0, ',', '.') . "</td>
        </tr>
        ";

        $no++;
        $totalOmset += $row['total'];
    }
} else {
    echo "<tr><td colspan='5' align='center'>Tidak ada data penjualan pada periode ini.</td></tr>";
}

echo "</tbody>";

// 6. Baris Total di Bawah
echo "
    <tfoot>
        <tr>
            <td colspan='5' style='background-color:#f0f0f0; border:none;'></td>
        </tr>
        <tr style='background-color:#ffff00; font-weight:bold; font-size:14px;'>
            <td colspan='4' align='center'>TOTAL PENDAPATAN</td>
            <td align='right'>Rp " . number_format($totalOmset, 0, ',', '.') . "</td>
        </tr>
    </tfoot>
</table>
";
?>