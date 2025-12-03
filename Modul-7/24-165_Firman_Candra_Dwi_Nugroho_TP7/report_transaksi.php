<?php include "config.php"; ?>

<h2>Report Transaksi</h2>
<form method="GET">
    Dari <input type="date" name="dari">
    Sampai <input type="date" name="sampai">
    <button type="submit">Filter</button>
</form>
<hr>

<?php if(isset($_GET['dari'])) {
    $d1 = $_GET['dari'];
    $d2 = $_GET['sampai'];

    $q = mysqli_query($conn,
    "SELECT t.tanggal, b.nama_barang, d.qty, d.subtotal 
     FROM transaksi t
     JOIN transaksi_detail d ON d.id_transaksi = t.id
     JOIN barang b ON b.id = d.id_barang
     WHERE tanggal BETWEEN '$d1' AND '$d2'");
?>
<h3>Hasil Laporan</h3>

<canvas id="grafik"></canvas>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
let label = [];
let total = [];

<?php
$g = mysqli_query($conn,
"SELECT tanggal, SUM(total) AS ttl 
 FROM transaksi 
 WHERE tanggal BETWEEN '$d1' AND '$d2'
 GROUP BY tanggal");

while($r=mysqli_fetch_assoc($g)) {
?>
    label.push("<?= $r['tanggal'] ?>");
    total.push(<?= $r['ttl'] ?>);
<?php } ?>

new Chart(document.getElementById('grafik'), {
    type: 'bar',
    data: { labels: label, datasets: [{ data: total }] }
});
</script>

<table border="1" cellpadding="7">
    <tr>
        <th>Tanggal</th>
        <th>Nama Barang</th>
        <th>Qty</th>
        <th>Subtotal</th>
    </tr>
    <?php while($r=mysqli_fetch_assoc($q)) { ?>
    <tr>
        <td><?= $r['tanggal'] ?></td>
        <td><?= $r['nama_barang'] ?></td>
        <td><?= $r['qty'] ?></td>
        <td><?= number_format($r['subtotal']) ?></td>
    </tr>
    <?php } ?>
</table>

<br>
<a href="export_excel.php?dari=<?= $_GET['dari'] ?? '' ?>&sampai=<?= $_GET['sampai'] ?? '' ?>" 
   class="btn btn-success">Export Excel</a>
<?php } ?>
