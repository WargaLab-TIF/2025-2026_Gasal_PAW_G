<?php session_start();
include 'koneksi.php';
$u=$_POST['username'];
$p=md5($_POST['password']);
$q=$conn->query("SELECT * FROM user WHERE username='$u' AND password='$p'");
if($q->num_rows>0){$d=$q->fetch_assoc();
    $level=($d['level']=='admin'||$d['level']=='manager')?1:2;
    $_SESSION['login']=true;
    $_SESSION['nama']=$d['nama'];
    $_SESSION['username']=$d['username'];
    $_SESSION['level']=$level
    ;header('Location: index.php');
}else{
    echo "<script>alert('Login gagal!');window.location='login.php';</script>";}?>