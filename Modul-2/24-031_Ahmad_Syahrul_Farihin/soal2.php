<?php
$matkul = ["PTI","ALPRO","DPW","STRUKDAT","JARKOM","PAW","PSBF","RPL"];
foreach ($matkul as $m) {
    switch ($m) {
        case "PTI":
            echo "Saya suka PTI<br>";
            break;
        case "ALPRO":
            echo "Saya suka ALPRO<br>";
            break;
        case "DPW":
            echo "Saya suka DPW<br>";
            break;
        case "STRUKDAT":
            echo "Saya suka STRUKDAT<br>";
            break;
        case "JARKOM":
            echo "Saya suka JARKOM<br>";
            break;
        case "PAW":
            echo "Saya suka PAW<br>";
            break;
        case "PSBF":
            echo "Saya tidak mengambil matkul PSBF<br>";
            break;
        case "RPL":
            echo "Saya tidak mengambil matkul RPL<br>";
            break;
        default:
            echo "Saya tidak mengambil matkul $m<br>";
    }
}
?>