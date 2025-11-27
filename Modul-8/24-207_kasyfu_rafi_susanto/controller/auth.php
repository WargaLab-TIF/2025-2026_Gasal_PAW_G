<?php
session_start();

if(!isset($_SESSION["login"])){
    header("location:../tampilan/form_login.php");
    exit;
}
?>