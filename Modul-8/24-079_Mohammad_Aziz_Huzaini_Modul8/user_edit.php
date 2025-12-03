<?php
session_start();
include 'koneksi.php';
if(!isset($_SESSION['login'])||$_SESSION['level']!=1){ header('Location: login.php'); exit; }
if(!isset($_GET['id'])) header('Location: user_list.php');
$id=(int)$_GET['id'];
if($_SERVER['REQUEST_METHOD']==='POST'){
    $nama=mysqli_real_escape_string($conn,$_POST['nama']);
    $level=(int)$_POST['level'];
    mysqli_query($conn,"UPDATE user SET nama='".mysqli_real_escape_string($conn,$nama)."', level=$level WHERE id_user=$id");
    if(!empty($_POST['password'])){ $pwd=md5($_POST['password']); mysqli_query($conn,"UPDATE user SET password='$pwd' WHERE id_user=$id"); }
    header('Location: user_list.php'); exit;
}
$r=mysqli_query($conn,"SELECT * FROM user WHERE id_user=$id"); $row=mysqli_fetch_assoc($r);
?>
<!DOCTYPE html>
<html>

<body>
    <h2>Edit User</h2>
    <form method='POST'>
        <label>Username: <input value='<?= htmlspecialchars($row['username']) ?>' disabled></label><br>
        Password (isi jika ganti): <input name='password' type='password'><br>
        Nama:<input name='nama' value='<?= htmlspecialchars($row['nama']) ?>' required><br>
        Level:<select name='level'>
            <option value='1' <?= $row['level']==1?'selected':'' ?>>1</option>
            <option value='2' <?= $row['level']==2?'selected':'' ?>>2</option>
        </select><br>
        <button type='submit'>Update</button>
    </form><a href='user_list.php'>Kembali</a>
</body>

</html>