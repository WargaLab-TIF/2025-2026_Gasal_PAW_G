<?php
include "koneksi.php";

if(isset($_POST['simpan'])){
    $pelanggan_id = $_POST['pelanggan_id'];
    $waktu = $_POST['waktu'];
    $keterangan = $_POST['keterangan'];
    $total = $_POST['total'];

    if(empty($waktu)){
        echo "<script>alert('Tanggal belum diisi!');history.back();</script>";
        exit;
    }

    if(empty($keterangan)){
        echo "<script>alert('Keterangan belum diisi!');history.back();</script>";
        exit;
    }

    if(empty($pelanggan_id)){
        echo "<script>alert('Pelanggan belum dipilih!');history.back();</script>";
        exit;
    }

    if($waktu < date("Y-m-d")){
        echo "<script>alert('Tanggal tidak boleh kurang dari hari ini!');history.back();</script>";
        exit;
    }

    if(strlen($keterangan) < 3){
        echo "<script>alert('Keterangan minimal 3 karakter!');history.back();</script>";
        exit;
    }

    mysqli_query($conn, "INSERT INTO transaksi(waktu_transaksi, keterangan, total, pelanggan_id)
                         VALUES('$waktu','$keterangan', '$total', '$pelanggan_id')");

    echo "<script>alert('Data transaksi ditambahkan');window.location='tambah_detail.php';</script>";
}
?>


<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

<div class="container py-5" style="max-width: 650px;">

    <h2 class="text-center mb-4 fw-bold">📝 Catat Transaksi Baru</h2>

    <div class="card shadow-lg">
        <div class="card-body">

            <form method="post">

                <div class="mb-3">
                    <label class="form-label">Waktu Transaksi</label>
                    <input type="date" name="waktu" class="form-control" >
                </div>

                <div class="mb-3">
                    <label class="form-label">Keterangan</label>
                    <textarea name="keterangan" class="form-control" placeholder="Masukkan keterangan transaksi..."></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Total (Rp)</label>
                    <input type="text" name="total" class="form-control" value="0" readonly>
                </div>

                <div class="mb-3">
                    <label class="form-label">Pelanggan</label>
                    <select name="pelanggan_id" class="form-select" >
                        <option value="">-- Pilih Pelanggan --</option>
                        <?php
                        $q = mysqli_query($conn, "SELECT * FROM pelanggan");
                        while($d = mysqli_fetch_assoc($q)){
                            echo "<option value='$d[id]'>$d[nama]</option>";
                        }
                        ?>
                    </select>
                </div>

                <button type="submit" name="simpan" class="btn btn-primary w-100 py-2 fw-semibold">
                    Simpan Transaksi
                </button>

            </form>

        </div>
    </div>

    <div class="text-center mt-4">
        <a href="index.php" class="btn btn-secondary">← Kembali</a>
    </div>

</div>
