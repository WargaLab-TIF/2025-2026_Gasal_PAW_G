<?php

$matkul = ["PTI", "ALPRO", "DPW", "STRUKDAT", "JARKOM", "PAW", "PSBF", "RPL"];
$praktikum = ["JARKOM", "PAW"];

for ($i = 0; $i < count($matkul); $i++) {
    $namaMatkul = $matkul[$i];

    if (in_array($namaMatkul, $praktikum)) {
        echo "Saya sedang mengambil matkul $namaMatkul termasuk praktikumnya<br>";
    } elseif ($i >= 6) {
        echo "Saya belum mengambil matkul $namaMatkul<br>";
    } else {
        echo "Saya sudah mengambil matkul $namaMatkul semester lalu<br>";
    }
}
?>
