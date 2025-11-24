<?php
include 'koneksi.php'; // Pastikan file koneksi.php Anda berfungsi dengan baik

// Query untuk mengambil data dari tabel supplier
$sql = "
    SELECT 
        id, 
        nama_supplier, 
        waktu, 
        keterangan
    FROM supplier
    ORDER BY waktu DESC, id ASC
";

$result = mysqli_query($conn, $sql);

// Periksa apakah kueri berhasil atau tidak
if (!$result) {
    // Jika gagal, hentikan skrip dan tampilkan error MySQL
    die("Error dalam kueri SQL: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Data Supplier</title>
<style>
    body { font-family: Arial; background: #f0f2f5; margin:0; padding:0; }

    .navbar {
        background: #333;
        padding: 12px 25px;
        color: white;
        font-size: 20px;
        font-weight: bold;
    }

    .container {
        width: 95%;
        margin: 20px auto;
    }

    .header-box {
        background: #4CAF50; /* Warna hijau untuk supplier */
        padding: 12px;
        color: white;
        font-size: 18px;
        font-weight: bold;
        border-radius: 6px 6px 0 0;
    }

    table {
        width:100%;
        border-collapse: collapse;
        background: white;
        border:1px solid #ccc;
    }

    th {
        background: #e8f5e9; /* Warna hijau muda */
        padding: 10px;
        border:1px solid #ccc;
    }

    td {
        padding: 10px;
        border:1px solid #ccc;
        text-align: center;
    }
</style>
</head>
<body>

<div class="navbar">Manajemen Supplier XYZ</div>

<div class="container">

    <div class="header-box">Data Master Supplier</div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>ID</th>
                <th>Nama Supplier</th>
                <th>Waktu Pasokan</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $no = 1;
            // Karena kita sudah memastikan $result valid di atas, kita bisa langsung looping
            while($row = mysqli_fetch_assoc($result)){ ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $row['id'] ?></td>
                <td><?= $row['nama_supplier'] ?></td>
                <td><?= $row['waktu'] ?></td>
                <td><?= $row['keterangan'] ?></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>

</div>

</body>
</html>
