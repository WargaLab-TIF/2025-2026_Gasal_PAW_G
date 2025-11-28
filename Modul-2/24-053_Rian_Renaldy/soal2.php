<?php

$matkul = ["PTI", "ALPRO", "DPW", "STRUKDAT", "JARKOM", "PAW", "PSBF", "RPL"];

foreach ($matkul as $mt){
    switch ($mt){
        case "PTI":
            echo "Saya suka $mt" . "<br>";
            break;
        case "ALPRO":
            echo "Saya suka $mt" . "<br>";
            break;
        case "DPW":
            echo "Saya suka $mt" . "<br>";
            break;
        case "STRUKDAT":
            echo "Saya suka $mt" . "<br>";
            break;
        case "JARKOM":
            echo "Saya suka $mt" . "<br>";
            break;
        case "PAW":
            echo "Saya suka $mt" . "<br>";
            break;
        default:
            echo "Saya tidak mengambil matkul $mt" . "<br>";
    }
}

?>