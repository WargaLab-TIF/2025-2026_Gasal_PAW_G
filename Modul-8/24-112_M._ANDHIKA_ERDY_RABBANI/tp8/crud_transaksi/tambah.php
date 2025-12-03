<?php
require_once "../session.php";
deny_if_not_logged_in();
require_once "../conn.php";
include "../navbar.php";

$barang = $conn->query("SELECT * FROM barang");
$pelanggan = $conn->query("SELECT * FROM pelanggan");
?>
<h2>Tambah Transaksi</h2>

<form method="post">
    Pelanggan:<br>
    <select name="pelanggan_id" required>
        <?php while($p = $pelanggan->fetch_assoc()): ?>
            <option value="<?= $p['id'] ?>"><?= $p['nama'] ?></option>
        <?php endwhile; ?>
    </select><br><br>

    Keterangan:<br>
    <textarea name="ket" required></textarea><br><br>

    <h3>Data Barang</h3>
    Barang:<br>
    <select name="barang_id" required>
        <?php
        $barang->data_seek(0);
        while($b = $barang->fetch_assoc()):
        ?>
            <option value="<?= $b['id'] ?>"><?= $b['nama_barang'] ?> (Rp <?= $b['harga'] ?>)</option>
        <?php endwhile; ?>
    </select><br><br>

    Qty:<br>
    <input type="number" name="qty" min="1" required><br><br>

    <button type="submit">Simpan Transaksi</button>
</form>

<?php
if ($_POST) {

    $pelanggan_id = $_POST['pelanggan_id'];
    $ket = $_POST['ket'];
    $barang_id = $_POST['barang_id'];
    $qty = $_POST['qty'];

    // ambil harga barang
    $h = $conn->query("SELECT harga FROM barang WHERE id=$barang_id")->fetch_assoc()['harga'];
    $total = $h * $qty;

    // buat transaksi utama
    $conn->query("
        INSERT INTO transaksi (waktu_transaksi, keterangan, total, pelanggan_id, user_id)
        VALUES (NOW(), '$ket', $total, '$pelanggan_id', ".$_SESSION['id_user'].")
    ");

    $id_transaksi = $conn->insert_id;

    // simpan detailnya
    $conn->query("
        INSERT INTO transaksi_detail (transaksi_id, barang_id, harga, qty)
        VALUES ($id_transaksi, $barang_id, $h, $qty)
    ");

    echo "<script>alert('Transaksi berhasil dibuat');location='transaksi.php'</script>";
}
?>
