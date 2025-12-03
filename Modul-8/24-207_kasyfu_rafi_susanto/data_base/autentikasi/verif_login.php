<?php
require_once __DIR__. "../../koneksi/koneksi.php";

if(isset($_POST["login"])){
    $user_name = $_POST["username"];
    $pw = $_POST["password"];
    $pw_MD5 = md5($pw);
    $ambil_data = "SELECT password, username, level FROM user";
    $find_data = $conn->query($ambil_data);
    while($row = $find_data->fetch_assoc()){
        if($row["password"] == $pw_MD5 && $row["username"]==$user_name){
            session_start();
            $_SESSION["username"] = $row["username"];
            $_SESSION["login"] = true;
            $_SESSION["level"] = $row["level"];
            if($_SESSION["level"] == 1){
                header("location:../tampilan/admin/home.php");
                exit;
            }else{
                header("location:../tampilan/user/home.php");
                exit;
            }
        }
    }
    $error = "masukan data yang bener";
}

?>