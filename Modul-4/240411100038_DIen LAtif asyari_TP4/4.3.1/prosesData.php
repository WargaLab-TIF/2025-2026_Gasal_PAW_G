<?php
require "validate.inc.php";
$list_name = [];

if (validateName($_POST,"surname")){
header('Location:dashboard.php');
    }else{
    echo "data invalid! ada error = ";
    foreach ($_POST as $key => $value) {
        echo $key . " = " . $value . '<br>'; 
}}
//perbedaan antara pengujian kali ini dan pengujian pada langkah 3 adalah perbedaan output yaitu pada pengujian kali ini
// terdapat penampilan error pada inputan surname 
?>