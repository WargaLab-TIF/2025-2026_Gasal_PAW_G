<?php
$matkul = ["PTI","ALPRO","DPW","STRUKDAT","JARKOM","PAW","PSBF","RPL"];
$praktikum = ["JARKOM","PAW"];

for ($i=0; $i < count($matkul); $i++) { 
    if (in_array($matkul[$i],$praktikum)) {
        echo"saya sedang mengambil matkul $matkul[$i] termasuk praktikum nya <br>";
    }
    elseif ($i == 6 || $i == 7) {
        echo"saya tidak mengambil matkul $matkul[$i].<br>";
    }
    else {
        echo "saya sudah mengambil matkul $matkul[$i] semester lalu.<br> ";
    }
}
?>  