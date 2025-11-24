<?php 
include '../cek_session.php'; 
include '../koneksi.php'; 

if($_SESSION['level'] != 1) {
    header("location:../home.php?pesan=akses_ditolak");
    exit(); 
}

if(isset($_GET['aksi']) && $_GET['aksi'] == 'hapus' && isset($_GET['id'])) {
    $id_supplier = mysqli_real_escape_string($koneksi, $_GET['id']);
    
    $hapus = mysqli_query($koneksi, "DELETE FROM supplier WHERE id_supplier='$id_supplier'");
    
    if($hapus) {
        header("location:supplier.php?pesan=berhasil_hapus");
    } else {
        header("location:supplier.php?pesan=gagal_hapus");
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Master Supplier</title>
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
    <h2>Data Master Supplier</h2>
    
    <?php 
    if(isset($_GET['pesan'])){
        if($_GET['pesan'] == "berhasil_tambah"){
            echo "<div class='alert alert-success'>Data supplier berhasil ditambahkan!</div>";
        }else if($_GET['pesan'] == "berhasil_edit"){
            echo "<div class='alert alert-success'>Data supplier berhasil diubah!</div>";
        }else if($_GET['pesan'] == "berhasil_hapus"){
            echo "<div class='alert alert-success'>Data supplier berhasil dihapus!</div>";
        }else if($_GET['pesan'] == "gagal_hapus"){
            echo "<div class='alert alert-danger'>Data supplier gagal dihapus. Mungkin data ini masih terhubung dengan Data Barang.</div>";
        }
    }
    ?>
    
    <div class="btn-container">
        <a href="supplier_tambah.php" class="btn btn-primary">Tambah Data Supplier</a>
        <a href="../home.php" class="btn btn-secondary">Kembali</a>
    </div>

    <table class="content-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Supplier</th>
                <th>Alamat</th>
                <th>Telepon</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $no = 1;
            $query_supplier = mysqli_query($koneksi, "SELECT * FROM supplier ORDER BY nama_supplier ASC");
            
            if (!$query_supplier) {
                echo "<tr><td colspan='5'><div class='alert alert-danger'>Kesalahan Query: " . mysqli_error($koneksi) . "</div></td></tr>";
            } else {
                while($d = mysqli_fetch_assoc($query_supplier)){
            ?>
            <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $d['nama_supplier']; ?></td>
                <td><?php echo $d['alamat']; ?></td>
                <td><?php echo $d['telepon']; ?></td>
                <td>
                    <a href="supplier_edit.php?id=<?php echo $d['id_supplier']; ?>" class="btn btn-warning">Edit</a>
                    <a href="supplier.php?aksi=hapus&id=<?php echo $d['id_supplier']; ?>" 
                       onclick="return confirm('Yakin ingin menghapus supplier <?php echo $d['nama_supplier']; ?>?')" class="btn btn-danger">Hapus</a>
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