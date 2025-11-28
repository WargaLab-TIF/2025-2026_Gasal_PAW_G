<?php
$matkul = array("PTI", "ALPRO", "DPW", "STRUKDAT", "JARKOM", "PAW", "PSBF", "RPL");

foreach($matkul as $m){
    $suka = "Saya suka $m <br>";
    switch($m){
        case "PTI":
            echo $suka;
            break;
        case "ALPRO":
            echo $suka;
            break;
        case "DPW":
            echo $suka;
            break;
        case "STRUKDAT":
            echo $suka;
            break;
        case "JARKOM":
            echo $suka;
            break;
        case "PAW":
            echo $suka;
            break;
        default:
            echo "Saya tidak mengambil matkul $m <br>";
            break;
    };
}
?>