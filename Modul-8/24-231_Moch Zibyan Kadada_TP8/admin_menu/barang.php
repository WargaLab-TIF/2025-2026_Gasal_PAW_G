<?php 
include '../cek_session.php'; 
include '../koneksi.php'; 

if($_SESSION['level'] != 1) {
    header("location:../home.php?pesan=akses_ditolak");
    exit(); 
}

if(isset($_GET['aksi']) && $_GET['aksi'] == 'hapus' && isset($_GET['id'])) {
    $id_barang = mysqli_real_escape_string($koneksi, $_GET['id']);
    
    $hapus = mysqli_query($koneksi, "DELETE FROM barang WHERE id_barang='$id_barang'");
    
    if($hapus) {
        header("location:barang.php?pesan=berhasil_hapus");
    } else {
        header("location:barang.php?pesan=gagal_hapus");
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Master Barang</title>
    <style>
        body { font-family: sans-serif; margin: 0; background-color: #f4f4f4; color: #333; }
        .container { 
            padding: 30px; 
            max-width: 960px; 
            margin: 40px auto; 
            background-color: white; 
            border-radius: 8px; 
            box-shadow: 0 4px 15px rgba(0,0,0,0.1); 
        }
        h2 { color: #333; margin-bottom: 25px; border-bottom: 2px solid #ddd; padding-bottom: 10px; }

        .content-table { 
            width: 100%; 
            border-collapse: collapse; 
            margin-top: 20px; 
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1); 
        }
        .content-table thead tr {
            background-color: #007bff;
            color: #ffffff;
            text-align: left;
        }
        .content-table th, .content-table td { 
            padding: 12px 15px; 
            border: 1px solid #dddddd;
        }
        .content-table tbody tr:nth-of-type(even) {
            background-color: #f3f3f3; 
        }
        .content-table tbody tr:hover {
            background-color: #e0e0e0;
        }
        
        .btn { 
            padding: 8px 12px; 
            text-decoration: none; 
            border-radius: 4px; 
            margin-right: 5px; 
            font-size: 14px; 
            display: inline-block;
            border: none;
            cursor: pointer;
            transition: background-color 0.2s;
        }
        .btn-primary { background-color: #007bff; color: white; }
        .btn-warning { background-color: #ffc107; color: #333; }
        .btn-danger { background-color: #dc3545; color: white; }
        .btn-secondary { background-color: #6c757d; color: white; }

        .btn-primary:hover { background-color: #0056b3; }
        .btn-warning:hover { background-color: #e0a800; }
        .btn-danger:hover { background-color: #bd2130; }
        .btn-secondary:hover { background-color: #5a6268; }

        .alert {
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 4px;
            text-align: left;
        }
        .alert-danger { background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
        .alert-success { background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; }

        .btn-container { margin-bottom: 20px; }
    </style>
</head>
<body>
<div class="container">
    <h2>Data Master Barang</h2>
    
    <?php 
    if(isset($_GET['pesan'])){
        if($_GET['pesan'] == "berhasil_tambah"){
            echo "<div class='alert alert-success'>Data barang berhasil ditambahkan!</div>";
        }else if($_GET['pesan'] == "berhasil_edit"){
            echo "<div class='alert alert-success'>Data barang berhasil diubah!</div>";
        }else if($_GET['pesan'] == "berhasil_hapus"){
            echo "<div class='alert alert-success'>Data barang berhasil dihapus!</div>";
        }else if($_GET['pesan'] == "gagal_hapus"){
            echo "<div class='alert alert-danger'>Data barang gagal dihapus!</div>";
        }
    }
    ?>
    
    <div class="btn-container">
        <a href="barang_tambah.php" class="btn btn-primary">Tambah Data Barang</a>
        <a href="../home.php" class="btn btn-secondary">Kembali</a>
    </div>

    <table class="content-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Stok</th>
                <th>Harga Jual</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $no = 1;
            $query_barang = mysqli_query($koneksi, "SELECT * FROM barang ORDER BY nama_barang ASC");
            
            if (!$query_barang) {
                echo "<tr><td colspan='6'><div class='alert alert-danger'>Kesalahan Query: " . mysqli_error($koneksi) . "</div></td></tr>";
            } else {
                while($d = mysqli_fetch_assoc($query_barang)){
            ?>
            <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $d['kode_barang']; ?></td>
                <td><?php echo $d['nama_barang']; ?></td>
                <td><?php echo $d['stok']; ?></td>
                <td>Rp <?php echo number_format($d['harga_jual'], 0, ',', '.'); ?></td>
                <td>
                    <a href="barang_edit.php?id=<?php echo $d['id_barang']; ?>" class="btn btn-warning">Edit</a>
                    <a href="barang.php?aksi=hapus&id=<?php echo $d['id_barang']; ?>" 
                       onclick="return confirm('Yakin ingin menghapus barang <?php echo $d['nama_barang']; ?>?')" class="btn btn-danger">Hapus</a>
                </td>
            </tr>
            <?php 
                } 
            } 
            ?>
        </tbody>
    </table>
</div>
</body>
</html>