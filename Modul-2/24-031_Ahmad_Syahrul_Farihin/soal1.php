<?php
$matkul = ["PTI","ALPRO","DPW","STRUKDAT","JARKOM","PAW","PSBF","RPL"];
$praktikum = ["JARKOM","PAW"];

for ($i = 0; $i < count($matkul); $i++) {
    $m = $matkul[$i];
    if (in_array($m, $praktikum)) {
        echo "Saya sedang mengambil matkul $m termasuk praktikum nya<br>";
    } elseif ($i == 6 || $i == 7) {
        echo "Saya belum mengambil matkul $m<br>";
    } else {
        echo "Saya sudah mengambil matkul $m semester lalu<br>";
    }
}
?>