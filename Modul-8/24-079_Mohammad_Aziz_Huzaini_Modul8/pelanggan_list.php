<?php
session_start();
include 'koneksi.php';
if(!isset($_SESSION['login'])){ header('Location: login.php'); exit; }
$res=mysqli_query($conn,'SELECT * FROM pelanggan ORDER BY id');
?>
<!DOCTYPE html>
<html>

<body>
    <h2>Pelanggan</h2>
    <?php if($_SESSION['level']==1) echo "<a href='pelanggan_add.php'>Tambah</a>"; ?> | <a
        href='data_master.php'>Kembali</a>
    <table border='1'>
        <?php while($r=mysqli_fetch_assoc($res)){ echo "<tr><td>{$r['id']}</td><td>".htmlspecialchars($r['nama'])."</td><td>".($_SESSION['level']==1?"<a href='pelanggan_edit.php?id={$r['id']}'>Edit</a> <a href='pelanggan_delete.php?id=<?= $r['id'] ?>'onclick="return confirm('Hapus?')">Hapus</a>":'')."</td></tr>"; } ?>
    </table>
</body>

</html>