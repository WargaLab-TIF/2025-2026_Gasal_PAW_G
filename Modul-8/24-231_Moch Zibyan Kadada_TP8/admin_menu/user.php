<?php 
include '../cek_session.php'; 
include '../koneksi.php'; 

if($_SESSION['level'] != 1) {
    header("location:../home.php?pesan=akses_ditolak");
    exit(); 
}

if(isset($_GET['aksi']) && $_GET['aksi'] == 'hapus' && isset($_GET['id'])) {
    $id_user = mysqli_real_escape_string($koneksi, $_GET['id']);
    $hapus = mysqli_query($koneksi, "DELETE FROM user WHERE id_user='$id_user'");
    
    if($hapus) {
        header("location:user.php?pesan=berhasil_hapus");
    } else {
        header("location:user.php?pesan=gagal_hapus");
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Master User</title>
    <style>
        body {
            background-color: #f4f4f4;
            color: #333;
            font-family: Arial, sans-serif;
            margin: 0;
        }

        .container {
            max-width: 900px;
            margin: 40px auto;
            background: white;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        h2 {
            margin-bottom: 20px;
        }

        .btn {
            display: inline-block;
            padding: 8px 14px;
            font-size: 14px;
            border-radius: 5px;
            text-decoration: none;
            color: white;
            margin-bottom: 10px;
        }

        .btn-primary { background: #007bff; }
        .btn-secondary { background: #6c757d; }
        .btn-warning { background: #f0ad4e; }
        .btn-danger { background: #d9534f; }

        .btn:hover {
            opacity: 0.85;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        table thead {
            background: #333;
            color: white;
        }

        table th, table td {
            padding: 10px 12px;
            border: 1px solid #ddd;
            font-size: 14px;
        }

        table tbody tr:hover {
            background: #f2f2f2;
        }

        /* Alert */
        .alert {
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 15px;
        }

        .alert-success { background: #d4edda; color: #155724; }
        .alert-danger { background: #f8d7da; color: #721c24; }
    </style>
</head>
<body>

<div class="container">
    <h2>Data Master User</h2>

    <?php 
    if(isset($_GET['pesan'])){
        if($_GET['pesan'] == "berhasil_tambah"){
            echo "<div class='alert alert-success'>Data user berhasil ditambahkan!</div>";
        } else if($_GET['pesan'] == "berhasil_edit"){
            echo "<div class='alert alert-success'>Data user berhasil diubah!</div>";
        } else if($_GET['pesan'] == "berhasil_hapus"){
            echo "<div class='alert alert-success'>Data user berhasil dihapus!</div>";
        } else if($_GET['pesan'] == "gagal_hapus"){
            echo "<div class='alert alert-danger'>Data user gagal dihapus!</div>";
        }
    }
    ?>

    <a href="user_tambah.php" class="btn btn-primary">Tambah Data User</a>
    <a href="../home.php" class="btn btn-secondary">Kembali ke Home</a>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama User</th>
                <th>Username</th>
                <th>Level</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $no = 1;
            $query_user = mysqli_query($koneksi, "SELECT * FROM user ORDER BY nama ASC");
            if (!$query_user) {
                echo "<tr><td colspan='5' style='color:red;'>Error Query: " . mysqli_error($koneksi) . "</td></tr>";
            } else {
                while($d = mysqli_fetch_assoc($query_user)){ 
            ?>
            <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $d['nama']; ?></td>
                <td><?php echo $d['username']; ?></td>
                <td><?php echo ($d['level'] == 1) ? "Owner" : "Kasir"; ?></td>
                <td>
                    <a href="user_edit.php?id=<?php echo $d['id_user']; ?>" class="btn btn-warning btn-sm">Edit</a>
                    <a href="user.php?aksi=hapus&id=<?php echo $d['id_user']; ?>" 
                       onclick="return confirm('Yakin ingin menghapus user <?php echo $d['nama']; ?>?')"
                       class="btn btn-danger btn-sm">Hapus</a>
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
