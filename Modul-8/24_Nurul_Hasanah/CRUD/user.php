<?php
include "../proteksi.php";
include "../koneksi.php";

if($_SESSION["level"] != 1){
    die("Akses ditolak");
}
?>

<h2>Data User</h2>
<a href="user_tambah.php">+ Tambah User</a>
<br><br>

<table border="1" cellpadding="10">
<tr>
    <th>ID</th>
    <th>Username</th>
    <th>Nama</th>
    <th>Level</th>
    <th>Aksi</th>
</tr>

<?php
$q = mysqli_query($koneksi, "SELECT * FROM user");

while($d = mysqli_fetch_assoc($q)){
    echo "<tr>
            <td>$d[id]</td>
            <td>$d[username]</td>
            <td>$d[nama]</td>
            <td>$d[level]</td>
            <td>
                <a href='user_edit.php?id=$d[id]'>Edit</a> |
                <a href='user_hapus.php?id=$d[id]' onclick='return confirm(\"Hapus user?\")'>Hapus</a>
            </td>
          </tr>";
}
?>
</table>