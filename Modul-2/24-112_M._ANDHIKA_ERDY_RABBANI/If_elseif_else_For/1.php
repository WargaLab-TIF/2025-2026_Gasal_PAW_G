<?php
$matkul = array("PTI", "ALPRO", "DPW", "STRUKDAT", "JARKOM", "PAW", "PSBF", "RPL");
$praktikum = array("JARKOM", "PAW");

// echo count($matkul); //8
for ($i=0; $i < count($matkul) ; $i++) { 
    $cek=$matkul[$i];
    if ($i<=3) {
        echo "Saya sudah mengambil matkul $cek semester lalu <br>";
    } elseif (in_array($cek, $praktikum)) {
        echo "Saya sedang mengambil matkul $cek termasuk praktikumnya <br>";
    }else {
        echo "Saya belum mengambil matkul $cek <br>";
    }
}

?>