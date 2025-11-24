<?php
require_once "db.php";
require_once "auth.php"; 

$sql_pelanggan = "SELECT id, nama FROM pelanggan ORDER BY nama ASC";
$result_pelanggan = mysqli_query($conn, $sql_pelanggan);
$pelanggan_list = mysqli_fetch_all($result_pelanggan, MYSQLI_ASSOC);

$sql_barang = "SELECT id, nama_barang, harga FROM barang ORDER BY nama_barang ASC";
$result_barang = mysqli_query($conn, $sql_barang);
$barang_list = mysqli_fetch_all($result_barang, MYSQLI_ASSOC);

$halaman_aktif = 'transaksi'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaksi Baru</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
</head>
<body>

    <?php require_once "navbar.php"; ?>

    <div class="container mt-4">
        <h2>Transaksi Baru</h2>
        
        <div class="card shadow-sm">
            <div class="card-body">
                <form action="proses_transaksi.php" method="POST">
                    <input type="hidden" name="action" value="create"> 
                    
                    <div class="mb-3">
                        <label for="pelanggan_id" class="form-label">Pelanggan</label>
                        <select class="form-select" id="pelanggan_id" name="pelanggan_id" required>
                            <option value="">-- Pilih Pelanggan --</option>
                            <?php foreach ($pelanggan_list as $pelanggan): ?>
                                <option value="<?php echo $pelanggan['id']; ?>"><?php echo htmlspecialchars($pelanggan['nama']); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="keterangan" class="form-label">Keterangan</label>
                        <input type="text" class="form-control" id="keterangan" name="keterangan">
                    </div>

                    <h4>Detail Barang (Hanya 1 Item untuk Simplifikasi)</h4>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="barang_id" class="form-label">Barang</label>
                            <select class="form-select" id="barang_id" name="barang_id" required>
                                <option value="">-- Pilih Barang --</option>
                                <?php foreach ($barang_list as $barang): ?>
                                    <option value="<?php echo $barang['id']; ?>" data-harga="<?php echo $barang['harga']; ?>">
                                        <?php echo htmlspecialchars($barang['nama_barang']); ?> (Rp <?php echo number_format($barang['harga']); ?>)
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="qty" class="form-label">Kuantitas (Qty)</label>
                            <input type="number" class="form-control" id="qty" name="qty" required min="1" value="1">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Total Sementara</label>
                            <input type="text" class="form-control" id="total_display" disabled value="Rp 0">
                            <input type="hidden" id="harga_jual" name="harga_jual">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary mt-3">Simpan Transaksi</button>
                </form>
            </div>
        </div>
    </div>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const barangSelect = document.getElementById('barang_id');
            const qtyInput = document.getElementById('qty');
            const totalDisplay = document.getElementById('total_display');
            const hargaJualInput = document.getElementById('harga_jual');

            function calculateTotal() {
                const selectedOption = barangSelect.options[barangSelect.selectedIndex];
                const harga = parseFloat(selectedOption.getAttribute('data-harga')) || 0;
                const qty = parseInt(qtyInput.value) || 0;
                
                const total = harga * qty;
                
                totalDisplay.value = 'Rp ' + total.toLocaleString('id-ID');
                hargaJualInput.value = harga; 
            }

            barangSelect.addEventListener('change', calculateTotal);
            qtyInput.addEventListener('input', calculateTotal);
            calculateTotal(); 
        });
    </script>
</body>
</html>