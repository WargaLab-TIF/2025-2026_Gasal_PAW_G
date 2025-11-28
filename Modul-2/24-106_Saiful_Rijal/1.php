<?php
$matkul = array("PTI", "ALPRO", "DPW", "STRUKDAT", "JARKOM", "PAW", "PSBF", "RPL");
$praktikum = array("JARKOM", "PAW");

for ($i = 0; $i < count($matkul); $i++){
    $cekpraktikum = false;
    for ($j = 0; $j < count($praktikum); $j++){
        if ($matkul[$i] === $praktikum[$j]) $cekpraktikum = true;
    };
    if ($cekpraktikum){
        echo "Saya sedang mengambil matkul $matkul[$i] termasuk praktikumnya";
    } else if ($i == 6 || $i == 7){
        echo "Saya belum mengambil matkul $matkul[$i]";
    } else {
        echo "Saya sudah mengambil matkul $matkul[$i] semester lalu";
    }
    echo "<br>";
}

?>