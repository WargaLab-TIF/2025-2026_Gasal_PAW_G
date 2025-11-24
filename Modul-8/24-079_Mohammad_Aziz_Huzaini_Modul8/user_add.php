<?php
session_start();
include 'koneksi.php';
if(!isset($_SESSION['login'])||$_SESSION['level']!=1){ header('Location: login.php'); exit; }
if($_SERVER['REQUEST_METHOD']==='POST'){
    $username=mysqli_real_escape_string($conn,$_POST['username']);
    $password=md5($_POST['password']);
    $nama=mysqli_real_escape_string($conn,$_POST['nama']);
    $level=(int)$_POST['level'];
    mysqli_query($conn,"INSERT INTO user (username,password,nama,level) VALUES ('".mysqli_real_escape_string($conn,$username)."','".$password."','".mysqli_real_escape_string($conn,$nama)."',$level)");
    header('Location: user_list.php'); exit;
}
?>
<!DOCTYPE html>
<html>

<body>
    <h2>Tambah User</h2>
    <form method='POST'>
        Username:<input name='username' required><br>
        Password:<input name='password' required><br>
        Nama:<input name='nama' required><br>
        Level:<select name='level'>
            <option value='1'>1</option>
            <option value='2'>2</option>
        </select><br>
        <button type='submit'>Simpan</button>
    </form><a href='user_list.php'>Kembali</a>
</body>

</html>