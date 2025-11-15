<?php
    $server = "localhost";
    $user = "root";
    $pass = "root";
    $database = "store";

    $conn = mysqli_connect($server, $user, $pass, $database);

    $id = $_GET["id"];
    $query = "DELETE FROM supplier WHERE id = $id";

    mysqli_query($conn, $query);
    header("location: Tugas-1.php");    
?>
