<?php
session_start();
include 'koneksi.php';
if(!isset($_SESSION['login'])){ header('Location: login.php'); exit; }
if($_SESSION['level']!=1){ echo 'Tidak ada akses'; exit; }

$res = mysqli_query($conn, "SELECT * FROM supplier ORDER BY id");
?>
<!DOCTYPE html>
<html>

<body>
    <h2>Supplier</h2>
    <a href='supplier_add.php'>Tambah</a> | <a href='data_master.php'>Kembali</a>
    <table border='1'>
        <?php while($r=mysqli_fetch_assoc($res)){ ?>
        <tr>
            <td><?= $r['id'] ?></td>
            <td><?= htmlspecialchars($r['nama']) ?></td>
            <td><a href='supplier_edit.php?id=<?= $r['id'] ?>'>Edit</a> <a href='supplier_delete.php?id=<?= $r['id'] ?>'
                    onclick="return confirm('Hapus?')">Hapus</a></td>
        </tr>
        <?php } ?>
    </table>
</body>

</html>