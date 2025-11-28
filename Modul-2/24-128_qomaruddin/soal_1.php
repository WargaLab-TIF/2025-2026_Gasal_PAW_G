<?php
$matkul = array("PTI", "ALPRO", "DPW", "STRUKDAT",
"JARKOM", "PAW", "PSBF", "RPL");

$praktikum = array("JARKOM","PAW");

for($i = 0; $i < count($matkul); $i++){
    if ($i == 6 or $i == 7){
        echo "saya belum mengambil matkul $matkul[$i]<br>";
    }elseif($matkul[$i] == $praktikum[0] or $matkul == $praktikum[1]){
        echo "Saya sedang mengambil matkul $matkul[$i] dan praktikum $praktikum[0] <br>";
    }else{
        echo "saya sudah mengambil matkul $matkul[$i] semester lalu <br>";
    }
}
?>