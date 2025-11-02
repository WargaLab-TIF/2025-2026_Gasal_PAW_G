<?php
$host = "localhost";
$username = "root";
$password = "";
$database  = "store"; 

$conn = mysqli_connect($host, $username, $password, $database);

if (!$conn) {
    echo "Koneksi gagal: " . mysqli_connect_error();
}
$result = mysqli_query($conn, "SELECT * FROM supplier");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Master Supplier</title>
    <style>
        body {
            font-family: Arial, sans-serif; 
            background: #f0f0f0;
        }
        h2 {
            text-align: center;
        }
        table {
            margin: 20px auto; 
            border-collapse: collapse; 
            width: 80%; 
            background: #fff;
        }
        th, td {
            border: 1px solid #ccc; 
            padding: 10px; 
            text-align: center;
        }
        th {
            background: #01203dff; 
            color: white;
        }
        a.button {
            padding: 8px 12px; 
            color: white; 
            text-decoration: none; 
            border-radius: 4px;
        }
        .add {
            background: #28a745;
        }
        .edit {
            background: #ffc107;
        }
        .delete {
            background: #dc3545;
        }
        .button:hover {
            opacity: 0.8;
        }
        .header-bar {
            width: 80%;
            margin: 0 auto 10px auto;  
            display: flex;
            justify-content: flex-end;  
        }
    </style>
</head>
<body>
    <h2>Data Master Supplier</h2>
    <div class="header-bar">
        <a href="add_supplier.php" class="button add">Tambah Data</a>
    </div>
    <table>
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Telepon</th>
            <th>Alamat</th>
            <th>Tindakan</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?= $row['id']; ?></td>
            <td><?= $row['nama']; ?></td>
            <td><?= $row['telp']; ?></td>
            <td><?= $row['alamat']; ?></td>
            <td>
                <a href="edit_supplier.php?id=<?= $row['id']; ?>" class="button edit">Edit</a>
                <a href="delete_supplier.php?id=<?= $row['id']; ?>" class="button delete" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
            </td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>
