<?php 
    session_start();
    if(!isset($_SESSION['id_user'])) {
        header("location: Tugas-1.php");
    }
?>