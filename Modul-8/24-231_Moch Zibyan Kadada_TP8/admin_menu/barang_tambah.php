<?php 
include '../cek_session.php'; 
include '../koneksi.php'; 

if($_SESSION['level'] != 1) {
    header("location:../home.php?pesan=akses_ditolak");
    exit(); 
}

if(isset($_POST['simpan'])){
    $kode_barang = mysqli_real_escape_string($koneksi, $_POST['kode_barang']);
    $nama_barang = mysqli_real_escape_string($koneksi, $_POST['nama_barang']);
    $satuan = mysqli_real_escape_string($koneksi, $_POST['satuan']);
    $harga_beli = mysqli_real_escape_string($koneksi, $_POST['harga_beli']);
    $harga_jual = mysqli_real_escape_string($koneksi, $_POST['harga_jual']);
    $stok = mysqli_real_escape_string($koneksi, $_POST['stok']);
    $id_supplier = mysqli_real_escape_string($koneksi, $_POST['id_supplier']);

    $simpan = mysqli_query($koneksi, "INSERT INTO barang 
        (kode_barang, nama_barang, satuan, harga_beli, harga_jual, stok, id_supplier) 
        VALUES ('$kode_barang', '$nama_barang', '$satuan', '$harga_beli', '$harga_jual', '$stok', '$id_supplier')");

    if($simpan){
        header("location:barang.php?pesan=berhasil_tambah");
    }else{
        header("location:barang.php?pesan=gagal_tambah");
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Data Barang</title>
    <style>
        /* CSS Form - Sama seperti user_tambah.php */
        body { font-family: sans-serif; margin: 0; background-color: #f4f4f4; color: #333; }
        .container { 
            padding: 30px; 
            max-width: 600px; 
            margin: 40px auto; 
            background-color: white; 
            border-radius: 8px; 
            box-shadow: 0 4px 15px rgba(0,0,0,0.1); 
        }
        h2 { color: #333; margin-bottom: 25px; border-bottom: 2px solid #ddd; padding-bottom: 10px; }
        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; margin-bottom: 8px; font-weight: bold; color: #555; }
        .form-group input[type="text"],
        .form-group input[type="number"],
        .form-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 16px;
        }
        .btn { padding: 10px 15px; text-decoration: none; border-radius: 4px; margin-right: 10px; font-size: 16px; border: none; cursor: pointer; transition: background-color 0.2s; }
        .btn-primary { background-color: #007bff; color: white; }
        .btn-secondary { background-color: #6c757d; color: white; }
        .btn-primary:hover { background-color: #0056b3; }
        .btn-secondary:hover { background-color: #5a6268; }
    </style>
</head>
<body>
<div class="container">
    <h2>Tambah Data Barang</h2>
    
    <form method="POST" action="">
        <div class="form-group">
            <label>Kode Barang</label>
            <input type="text" name="kode_barang" required>
        </div>
        <div class="form-group">
            <label>Nama Barang</label>
            <input type="text" name="nama_barang" required>
        </div>
        <div class="form-group">
            <label>Satuan</label>
            <input type="text" name="satuan" required>
        </div>
        <div class="form-group">
            <label>Harga Beli (Modal)</label>
            <input type="number" name="harga_beli" required min="0">
        </div>
        <div class="form-group">
            <label>Harga Jual</label>
            <input type="number" name="harga_jual" required min="0">
        </div>
        <div class="form-group">
            <label>Stok Awal</label>
            <input type="number" name="stok" required min="0">
        </div>
        <div class="form-group">
            <label>Supplier</label>
            <select name="id_supplier" required>
                <option value="">Pilih Supplier</option>
                <?php 
                // Ambil data supplier untuk dropdown
                $supplier = mysqli_query($koneksi, "SELECT id_supplier, nama_supplier FROM supplier ORDER BY nama_supplier ASC");
                while($s = mysqli_fetch_assoc($supplier)){
                    echo "<option value='{$s['id_supplier']}'>{$s['nama_supplier']}</option>";
                }
                ?>
            </select>
        </div>
        <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
        <a href="barang.php" class="btn btn-secondary">Batal</a>
    </form>
</div>
</body>
</html>