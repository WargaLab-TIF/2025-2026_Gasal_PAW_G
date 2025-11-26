<?php
session_start();
include 'koneksi.php';
if(!isset($_SESSION['login'])||$_SESSION['level']!=1){ header('Location: login.php'); exit; }
$res=mysqli_query($conn,'SELECT * FROM user ORDER BY id_user');
?>
<!DOCTYPE html>
<html>

<body>
    <h2>User</h2><a href='user_add.php'>Tambah</a> | <a href='data_master.php'>Kembali</a>
    <table border='1'>
        <?php while($r=mysqli_fetch_assoc($res)){ echo "<tr><td>{$r['id_user']}</td><td>".htmlspecialchars($r['username'])."</td><td>".htmlspecialchars($r['nama'])."</td><td>{$r['level']}</td><td><a href='user_edit.php?id={$r['id_user']}'>Edit</a> <a href='user_delete.php?id={$r['id_user']}' onclick=\"return confirm('Hapus?')\">Hapus</a></td></tr>"; } ?>
    </table>
</body>

</html>    