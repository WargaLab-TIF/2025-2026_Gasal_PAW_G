<?php 

$matkul = ["PTI","ALPRO","DPW","STRUKDAT","JARKOM","PAW","PSBF","RPL"];
$praktikum = ["JARKOM", "PAW"];

for($i = 0; $i < count($matkul);$i++) {
    $mk = $matkul[$i];
    if (in_array($mk, $praktikum)){
        echo "Saya sedang mengambil matkul $mk termasuk praktikumnya";
    } elseif ($i == 6 || $i == 7) {
        echo "Saya belum mengambil matkul $mk";
    } else {
        echo "Saya sudah mengambil matkul $mk semester lalu";
    }
    echo "<br>";
}

?>