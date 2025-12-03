<?php
include "proteksi.php";
include "koneksi.php";

// Owner dan kasir boleh akses laporan
?>

<h2>Laporan Transaksi</h2>

<table border="1" cellpadding="10">
<tr>
    <th>ID</th>
    <th>Tanggal</th>
    <th>Pelanggan</th>
    <th>Total</th>
    <th>Kasir</th>
</tr>

<?php
$q = mysqli_query($koneksi, 
        "SELECT t.*, p.nama_pelanggan, u.nama 
        FROM transaksi t
        LEFT JOIN pelanggan p ON t.id_pelanggan=p.id_pelanggan
        LEFT JOIN user u ON t.id_user=u.id");

while($d = mysqli_fetch_assoc($q)){
    echo "<tr>
            <td>$d[id_transaksi]</td>
            <td>$d[tanggal]</td>
            <td>$d[nama_pelanggan]</td>
            <td>$d[total]</td>
            <td>$d[nama]</td>
          </tr>";
}
?>
</table>