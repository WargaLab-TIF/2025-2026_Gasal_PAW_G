<?php
include "koneksi.php";

if(isset($_POST['simpan'])){
    $transaksi_id = $_POST['transaksi_id'];
    $barang_id = $_POST['barang_id'];
    $qty = $_POST['qty'];

    $cek = mysqli_query($conn, "SELECT * FROM transaksi_detail WHERE transaksi_id='$transaksi_id' AND barang_id='$barang_id'");
    if(mysqli_num_rows($cek) > 0){
        echo "<script>alert('Barang sudah ada dalam transaksi ini!');history.back();</script>";
        exit;
    }

    $b = mysqli_fetch_assoc(mysqli_query($conn, "SELECT harga FROM barang WHERE id='$barang_id'"));
    $harga = $b['harga'] * $qty;

    mysqli_query($conn, "INSERT INTO transaksi_detail(transaksi_id, barang_id, qty, harga)
                         VALUES('$transaksi_id','$barang_id','$qty','$harga')");

    mysqli_query($conn, "UPDATE transaksi SET total = (
        SELECT SUM(harga) FROM transaksi_detail WHERE transaksi_id='$transaksi_id'
    ) WHERE id='$transaksi_id'");

    echo "<script>alert('Detail transaksi ditambahkan');location.href='tambah_detail.php';</script>";
}

?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

<div class="container py-5" style="max-width: 600px;">

    <h2 class="mb-4 text-center fw-bold">➕ Tambah Detail Transaksi</h2>

    <div class="card shadow-lg">
        <div class="card-body">

            <form method="post">

                <div class="mb-3">
                    <label class="form-label">Pilih Transaksi</label>
                    <select name="transaksi_id" class="form-select" required>
                        <option value="">-- Pilih ID Transaksi --</option>
                        <?php
                        $t = mysqli_query($conn, "SELECT * FROM transaksi");
                        while($tr = mysqli_fetch_assoc($t)){
                            echo "<option value='$tr[id]'>#{$tr['id']} - Total: Rp ".number_format($tr['total'],0,',','.') ."</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Pilih Barang</label>
                    <select name="barang_id" class="form-select" required>
                        <option value="">-- Pilih Barang --</option>
                        <?php
                        $b = mysqli_query($conn, "SELECT * FROM barang");
                        while($br = mysqli_fetch_assoc($b)){
                            echo "<option value='$br[id]'>$br[nama_barang] - Rp ".number_format($br['harga'],0,',','.') ."</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Jumlah (Qty)</label>
                    <input type="number" name="qty" min="1" value="1" class="form-control" required>
                </div>

                <button type="submit" name="simpan" class="btn btn-primary w-100 py-2 fw-semibold">
                    Tambah Detail
                </button>

            </form>

        </div>
    </div>

    <div class="text-center mt-4">
        <a href="index.php" class="btn btn-secondary">← Kembali</a>
    </div>

</div>

