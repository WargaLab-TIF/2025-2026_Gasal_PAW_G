<?php
include 'config.php';

if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    mysqli_query($conn, "DELETE FROM supplier WHERE id='$id'");
    header("Location: index.php");
    exit;
}

$result = mysqli_query($conn, "SELECT * FROM supplier");
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Data Master Supplier</title>
    <style>
        body {
            font-family: 'Times New Roman', serif;
            background-color: #f5f5f5;
        }
        h2 {
            text-align: center;
            margin-top: 30px;
        }
        .container {
            width: 80%;
            margin: 20px auto;
            background: white;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        table th, table td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: center;
        }
        table th {
            background-color: #4CAF50;
            color: white;
        }
        .btn {
            padding: 6px 12px;
            border: none;
            border-radius: 4px;
            color: white;
            cursor: pointer;
            text-decoration: none;
            font-family: 'Times New Roman', serif;
        }
        .tambah {
            background-color: #2196F3;
            margin-bottom: 15px;
            display: inline-block;
        }
        .edit {
            background-color: #FFC107;
        }
        .hapus {
            background-color: #f44336;
        }
        .no-data {
            text-align: center;
            color: #777;
            padding: 20px;
        }
    </style>
</head>
<body>
    <h2>Data Master Supplier</h2>

    <div class="container">
        <a href="tambah.php" class="btn tambah">+ Tambah Data</a>
        <table>
            <tr>
                <th>No</th>
                <th>Nama Supplier</th>
                <th>No. Telepon</th>
                <th>Alamat</th>
                <th>Aksi</th>
            </tr>
            <?php
            if (mysqli_num_rows($result) > 0):
                $no = 1;
                while ($row = mysqli_fetch_assoc($result)):
            ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= htmlspecialchars($row['nama']); ?></td>
                <td><?= htmlspecialchars($row['telp']); ?></td>
                <td><?= htmlspecialchars($row['alamat']); ?></td>
                <td>
                    <a href="edit.php?id=<?= $row['id']; ?>" class="btn edit">Edit</a>
                    <a href="index.php?hapus=<?= $row['id']; ?>" 
                       class="btn hapus" 
                       onclick="return confirm('Anda yakin akan menghapus supplier ini?')">Hapus</a>
                </td>
            </tr>
            <?php endwhile; else: ?>
            <tr>
                <td colspan="5" class="no-data">Belum ada data supplier.</td>
            </tr>
            <?php endif; ?>
        </table>
    </div>
</body>
</html>
