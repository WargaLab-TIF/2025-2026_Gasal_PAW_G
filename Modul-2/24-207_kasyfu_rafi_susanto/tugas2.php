<?php 
$matkul = ["PTI","ALPRO","DPW","STRUKDAT","JARKOM","PAW","PSBF","RPL"];
foreach($matkul as $var){
    switch($var){
        case "PTI":
            echo "saya suka $var <br>";
            break;
        case "ALPRO":
            echo "saya suka $var <br>";
            break;
        case "DPW":
            echo "saya suka $var <br>";
            break;
        case "STRUKDAT":
            echo "saya suka $var <br>";
            break;
        case "JARKOM":
            echo "saya suka $var <br>";
            break;
        case "PAW":
            echo "saya suka $var <br>";
            break;
        default:
            echo "saya tidak mengambil $var <br>";
            break;
    }   
}

?>