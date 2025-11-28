<?php
$matkul = array("PTI", "ALPRO", "DPW", "STRUKDAT",
"JARKOM", "PAW", "PSBF", "RPL");

foreach($matkul as $mk){
    switch($mk){
        case "PTI":
            echo "saya suka $mk <br>";
            break;
        case "ALPRO":
            echo "Saya suka $mk <br>";
            break;
        case "DPW":
            echo "saya suka $mk <br>";
            break;
        case "STRUKDAT":
            echo "saya suka $mk <br>";
            break;
        case "JARKOM":
            echo "saya suka $mk <br>";
            break;
        case "PAW":
            echo "saya suka $mk <br>";
            break;
        default:
            echo "saya belum mengambil $mk <br>";
            break;
    }
}
?>