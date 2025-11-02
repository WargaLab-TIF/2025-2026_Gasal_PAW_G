<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "store";
$conn = mysqli_connect($host, $user, $pass, $db);
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

$sql = "SELECT * FROM supplier";
$res = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Data Supplier</title>
</head>
<body>
    <h2>Data Master Supplier</h2>
    <p><a href="Tugas-2.php">Tambah Data</a></p>

    <table border="1" cellpadding="6" cellspacing="0">
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Telp</th>
            <th>Alamat</th>
            <th>Tindakan</th>
        </tr>

        <?php
        $no = 1;
        while ($row = mysqli_fetch_assoc($res)) {
            $id = $row['id'];
            $nama = $row['nama'];
            $telp = $row['telp'];
            $alamat = $row['alamat'];
            echo "<tr>";
            echo "<td>$no</td>";
            echo "<td>$nama</td>";
            echo "<td>$telp</td>";
            echo "<td>$alamat</td>";
            echo "<td>
                    <a href='Tugas-3.php?id=$id'>Edit</a> |
                    <a href='Tugas-4.php?id=$id' onclick=\"return confirm('Anda yakin akan menghapus supplier ini?')\">Hapus</a>
                  </td>";
            echo "</tr>";
            $no++;
        }
        ?>
    </table>
</body>
</html>