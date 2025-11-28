<?php
$matkul = ["PTI","ALPRO","DPW","STRUKDAT","JARKOM","PAW","PSBF","RBL"];

foreach ($matkul as $key) {
    switch ($key) {
        case 'PTI':
            echo"saya suka $key <br>";
            break;

        case 'ALPRO':
            echo"saya suka $key <br>";
            break;

        case 'DPW':
            echo"saya suka $key <br>";
            break;

        case 'STRUKDAT':
            echo"saya suka $key <br>";
            break;

        case 'JARKOM':
            echo"saya suka $key <br>";
            break;
        
        case 'PAW':
            echo"saya suka $key <br>";
            break;

        default:
            echo "saya tidak mengambil matkul $key <br>";
            break;
    }
}
?>