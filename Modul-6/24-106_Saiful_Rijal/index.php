<?php
    include "koneksi.php";

    $barang = mysqli_query($conn, "SELECT * FROM barang");
    $transaksi = mysqli_query($conn, "SELECT * FROM transaksi");
    $detail = mysqli_query($conn, "SELECT * FROM transaksi_detail");

    $result_barang = mysqli_fetch_all($barang, MYSQLI_ASSOC);
    $result_transaksi = mysqli_fetch_all($transaksi, MYSQLI_ASSOC);
    $result_detail = mysqli_fetch_all($detail, MYSQLI_ASSOC);
?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

<div class="container py-4">

    <h2 class="mb-3">Data Barang</h2>
    <table class="table table-bordered table-hover table-striped align-middle">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Supplier</th>
                <th width="100">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($result_barang as $brg){ 
                $nama_supplier = mysqli_fetch_assoc(mysqli_query($conn, "SELECT nama FROM supplier WHERE id = $brg[supplier_id]"))['nama'];
            ?>
            <tr>
                <td><?= $brg['id']; ?></td>
                <td><?= $brg['kode_barang']; ?></td>
                <td><?= $brg['nama_barang']; ?></td>
                <td>Rp <?= number_format($brg['harga'], 0, ',', '.'); ?></td>
                <td><?= $brg['stok']; ?></td>
                <td><?= $nama_supplier; ?></td>
                <td>
                    <a href="hapus_barang.php?id=<?= $brg['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus barang ini?');">Delete</a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>



    <h2 class="mt-5 mb-3">Data Transaksi</h2>
    <table class="table table-bordered table-hover table-striped align-middle">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Waktu</th>
                <th>Keterangan</th>
                <th>Total</th>
                <th>Pelanggan</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($result_transaksi as $trs){ 
                $nama_pelanggan = mysqli_fetch_assoc(mysqli_query($conn, "SELECT nama FROM pelanggan WHERE id='$trs[pelanggan_id]'"))['nama'];
            ?>
            <tr>
                <td><?= $trs['id']; ?></td>
                <td><?= $trs['waktu_transaksi']; ?></td>
                <td><?= $trs['keterangan']; ?></td>
                <td class="fw-bold text-success">Rp <?= number_format($trs['total'], 0, ',', '.'); ?></td>
                <td><?= $nama_pelanggan; ?></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
    <a href="tambah_transaksi.php" class="btn btn-primary">➕ Tambah Transaksi</a>


    <h2 class="mt-5 mb-3">Detail Transaksi</h2>
    <table class="table table-bordered table-hover table-striped align-middle">
        <thead class="table-dark">
            <tr>
                <th>ID Transaksi</th>
                <th>Nama Barang</th>
                <th>Harga</th>
                <th>Qty</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($result_detail as $dtl){ 
                $nama_barang = mysqli_fetch_assoc(mysqli_query($conn, "SELECT nama_barang FROM barang WHERE id = '$dtl[barang_id]'"))['nama_barang'];
            ?>
            <tr>
                <td><?= $dtl['transaksi_id']; ?></td>
                <td><?= $nama_barang; ?></td>
                <td>Rp <?= number_format($dtl['harga'], 0, ',', '.'); ?></td>
                <td><?= $dtl['qty']; ?></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>

    <a href="tambah_detail.php" class="btn btn-success">➕ Tambah Detail Transaksi</a>

</div>

