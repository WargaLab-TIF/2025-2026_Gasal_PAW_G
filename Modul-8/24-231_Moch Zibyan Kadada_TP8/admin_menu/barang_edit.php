<?php 
include '../cek_session.php'; 
include '../koneksi.php'; 

// --- PROTEKSI LEVEL 1 (OWNER) ---
if($_SESSION['level'] != 1) {
    header("location:../home.php?pesan=akses_ditolak");
    exit(); 
}

$d = []; // Inisialisasi array untuk data barang

// 1. Ambil data lama berdasarkan ID
if(isset($_GET['id'])){
    $id_barang = mysqli_real_escape_string($koneksi, $_GET['id']);
    $data_barang = mysqli_query($koneksi, "SELECT * FROM barang WHERE id_barang='$id_barang'");
    $d = mysqli_fetch_assoc($data_barang);
    
    if(!$d) {
        header("location:barang.php?pesan=data_tidak_ditemukan");
        exit();
    }
} else {
    header("location:barang.php?pesan=id_kosong");
    exit();
}

// 2. Logika Update Data
if(isset($_POST['update'])){
    $id_barang_update = mysqli_real_escape_string($koneksi, $_POST['id_barang']);
    $kode_barang = mysqli_real_escape_string($koneksi, $_POST['kode_barang']);
    $nama_barang = mysqli_real_escape_string($koneksi, $_POST['nama_barang']);
    $satuan = mysqli_real_escape_string($koneksi, $_POST['satuan']);
    $harga_beli = mysqli_real_escape_string($koneksi, $_POST['harga_beli']);
    $harga_jual = mysqli_real_escape_string($koneksi, $_POST['harga_jual']);
    $stok = mysqli_real_escape_string($koneksi, $_POST['stok']);
    $id_supplier = mysqli_real_escape_string($koneksi, $_POST['id_supplier']);

    $query = "UPDATE barang SET 
        kode_barang='$kode_barang', 
        nama_barang='$nama_barang', 
        satuan='$satuan',
        harga_beli='$harga_beli', 
        harga_jual='$harga_jual', 
        stok='$stok',
        id_supplier='$id_supplier' 
        WHERE id_barang='$id_barang_update'";

    $update = mysqli_query($koneksi, $query);

    if($update){
        header("location:barang.php?pesan=berhasil_edit");
    }else{
        header("location:barang.php?pesan=gagal_edit");
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Data Barang</title>
    <style>
        /* CSS Form - Sama seperti barang_tambah.php */
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
    <h2>Edit Data Barang</h2>
    
    <form method="POST" action="">
        <input type="hidden" name="id_barang" value="<?php echo $d['id_barang']; ?>">
        
        <div class="form-group">
            <label>Kode Barang</label>
            <input type="text" name="kode_barang" value="<?php echo htmlspecialchars($d['kode_barang']); ?>" required>
        </div>
        <div class="form-group">
            <label>Nama Barang</label>
            <input type="text" name="nama_barang" value="<?php echo htmlspecialchars($d['nama_barang']); ?>" required>
        </div>
        <div class="form-group">
            <label>Satuan</label>
            <input type="text" name="satuan" value="<?php echo htmlspecialchars($d['satuan']); ?>" required>
        </div>
        <div class="form-group">
            <label>Harga Beli (Modal)</label>
            <input type="number" name="harga_beli" value="<?php echo $d['harga_beli']; ?>" required min="0">
        </div>
        <div class="form-group">
            <label>Harga Jual</label>
            <input type="number" name="harga_jual" value="<?php echo $d['harga_jual']; ?>" required min="0">
        </div>
        <div class="form-group">
            <label>Stok</label>
            <input type="number" name="stok" value="<?php echo $d['stok']; ?>" required min="0">
        </div>
        <div class="form-group">
            <label>Supplier</label>
            <select name="id_supplier" required>
                <option value="">Pilih Supplier</option>
                <?php 
                $supplier = mysqli_query($koneksi, "SELECT id_supplier, nama_supplier FROM supplier ORDER BY nama_supplier ASC");
                while($s = mysqli_fetch_assoc($supplier)){
                    // Menambahkan 'selected' jika id_supplier cocok
                    $selected = ($s['id_supplier'] == $d['id_supplier']) ? 'selected' : '';
                    echo "<option value='{$s['id_supplier']}' {$selected}>{$s['nama_supplier']}</option>";
                }
                ?>
            </select>
        </div>
        <button type="submit" name="update" class="btn btn-primary">Update</button>
        <a href="barang.php" class="btn btn-secondary">Batal</a>
    </form>
</div>
</body>
</html>