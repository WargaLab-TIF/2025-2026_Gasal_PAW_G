<?php 
include '../cek_session.php'; 
include '../koneksi.php'; 

// --- PROTEKSI LEVEL 1 (OWNER) ---
if($_SESSION['level'] != 1) {
    header("location:../home.php?pesan=akses_ditolak");
    exit(); 
}

$d = []; // Inisialisasi array untuk data supplier

// 1. Ambil data lama berdasarkan ID
if(isset($_GET['id'])){
    $id_supplier = mysqli_real_escape_string($koneksi, $_GET['id']);
    $data_supplier = mysqli_query($koneksi, "SELECT * FROM supplier WHERE id_supplier='$id_supplier'");
    $d = mysqli_fetch_assoc($data_supplier);
    
    if(!$d) {
        header("location:supplier.php?pesan=data_tidak_ditemukan");
        exit();
    }
} else {
    header("location:supplier.php?pesan=id_kosong");
    exit();
}

// 2. Logika Update Data
if(isset($_POST['update'])){
    $id_supplier_update = mysqli_real_escape_string($koneksi, $_POST['id_supplier']);
    $nama_supplier = mysqli_real_escape_string($koneksi, $_POST['nama_supplier']);
    $alamat = mysqli_real_escape_string($koneksi, $_POST['alamat']);
    $telepon = mysqli_real_escape_string($koneksi, $_POST['telepon']);

    $query = "UPDATE supplier SET 
        nama_supplier='$nama_supplier', 
        alamat='$alamat', 
        telepon='$telepon'
        WHERE id_supplier='$id_supplier_update'";

    $update = mysqli_query($koneksi, $query);

    if($update){
        header("location:supplier.php?pesan=berhasil_edit");
    }else{
        header("location:supplier.php?pesan=gagal_edit");
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Data Supplier</title>
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
    <h2>Edit Data Supplier</h2>
    
    <form method="POST" action="">
        <input type="hidden" name="id_supplier" value="<?php echo $d['id_supplier']; ?>">
        
        <div class="form-group">
            <label>Nama Supplier</label>
            <input type="text" name="nama_supplier" value="<?php echo htmlspecialchars($d['nama_supplier']); ?>" required>
        </div>
        <div class="form-group">
            <label>Alamat</label>
            <textarea name="alamat" required rows="3"><?php echo htmlspecialchars($d['alamat']); ?></textarea>
        </div>
        <div class="form-group">
            <label>Telepon</label>
            <input type="text" name="telepon" value="<?php echo htmlspecialchars($d['telepon']); ?>" required>
        </div>
        
        <button type="submit" name="update" class="btn btn-primary">Update</button>
        <a href="supplier.php" class="btn btn-secondary">Batal</a>
    </form>
</div>
</body>
</html>