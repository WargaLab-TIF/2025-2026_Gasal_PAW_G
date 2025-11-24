<?php
require_once __DIR__. "../../koneksi/koneksi.php";

$select_data = "SELECT * FROM user";
$find_data = $conn->query($select_data);

$ls_user = [];
while($row = $find_data->fetch_assoc()){
    if($row["level"] == 1){
        $row["level"] = "Admin";
    }else{
        $row["level"] = "User Biasa";
    }
    $ls_user[] = $row;
}

?>