<?php
include "koneksi.php"; 

$data = mysqli_query($koneksi, "SELECT * FROM supplier");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Supplier</title>
    <style>
        body { font-family: Arial; margin: 40px; }
        h2 { color: #333; }
        table { border-collapse: collapse; width: 80%; }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #ddd;
        }
        a { text-decoration: none; color: blue; }
    </style>
</head>
<body>
    <h2>Data Supplier</h2>
    <a href="tambah_supplier.php">+ Tambah supplier</a>
    <br><br>

    <table>
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>No. Telp</th>
            <th>Alamat</th>
            <th>Aksi</th>
        </tr>

        <?php
        
        while ($row = mysqli_fetch_assoc($data)) {
        ?>
            <tr>
                <td><?= $row['id_supplier']; ?></td>
                <td><?= $row['nama']; ?></td>
                <td><?= $row['telp']; ?></td>
                <td><?= $row['alamat']; ?></td>
                <td>
                    <a href="edit_supplier.php?id=<?= $row['id_supplier']; ?>">Edit</a> |
                    <a href="hapus_supplier.php?id=<?= $row['id_supplier']; ?>" onclick="return confirm('Yakin mau hapus data ini?')">Hapus</a>
                </td>
            </tr>
        <?php
        }
        ?>
    </table>
</body>
</html>
