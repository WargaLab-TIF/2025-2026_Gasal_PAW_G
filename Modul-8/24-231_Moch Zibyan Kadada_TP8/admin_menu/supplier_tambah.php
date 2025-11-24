<?php 
include '../cek_session.php'; 
include '../koneksi.php'; 

// --- PROTEKSI LEVEL 1 (OWNER) ---
if($_SESSION['level'] != 1) {
    header("location:../home.php?pesan=akses_ditolak");
    exit(); 
}

// --- LOGIKA SIMPAN DATA BARU ---
if(isset($_POST['simpan'])){
    $nama_supplier = mysqli_real_escape_string($koneksi, $_POST['nama_supplier']);
    $alamat = mysqli_real_escape_string($koneksi, $_POST['alamat']);
    $telepon = mysqli_real_escape_string($koneksi, $_POST['telepon']);

    $simpan = mysqli_query($koneksi, "INSERT INTO supplier 
        (nama_supplier, alamat, telepon) 
        VALUES ('$nama_supplier', '$alamat', '$telepon')");

    if($simpan){
        header("location:supplier.php?pesan=berhasil_tambah");
    }else{
        header("location:supplier.php?pesan=gagal_tambah");
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Data Supplier</title>
    <style>
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
        .form-group textarea {
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
    <h2>Tambah Data Supplier</h2>
    
    <form method="POST" action="">
        <div class="form-group">
            <label>Nama Supplier</label>
            <input type="text" name="nama_supplier" required>
        </div>
        <div class="form-group">
            <label>Alamat</label>
            <textarea name="alamat" required rows="3"></textarea>
        </div>
        <div class="form-group">
            <label>Telepon</label>
            <input type="text" name="telepon" required>
        </div>
        <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
        <a href="supplier.php" class="btn btn-secondary">Batal</a>
    </form>
</div>
</body>
</html>