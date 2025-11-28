<?php
$matkul=array("PTI","ALPRO","DPW","strukdat","JARKOM","PAW","Psbf","RPL");
foreach($matkul as $x){
    switch ($x){
        case "PTI":
            echo "saya suka PTI" . "<br>";
            break;
        case "ALPRO":
            echo "saya suka ALPRO". "<br>";
            break;
        case "DPW":
            echo "saya suka DPW". "<br>";
            break;
        case "strukdat":
            echo "saya suka strukdat". "<br>";
            break;
        case "JARKOM":
            echo "saya suka JARKOM". "<br>";
            break;
        case "PAW":
            echo "saya suka PAW". "<br>";
            break;
        default: 
            echo "saya tidak mengambil matkul". $x. "<br>";
            break ;
}}



