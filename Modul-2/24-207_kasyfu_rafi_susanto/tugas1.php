<?php

$matkul = ["PTI","ALPRO","DPW","STRUKDAT","JARKOM","PAW","PSBF","RPL"];
$praktikum = ["JARKOM","PAW"];
for ( $i = 0; $i < count($matkul); $i++)
        if ($i === 6 or $i === 7){
            echo "saya belum mengambil matkul $matkul[$i] <br>";
        }elseif ($matkul[$i] === $praktikum[0] or $matkul[$i] === $praktikum[1]){
            echo "Saya sedang mengambil matkul $matkul[$i] termasuk praktikumnya <br>";
        }else{
            echo "saya sudah mengambil matkul $matkul[$i] semester lalu <br>";
        }
        echo "<br>";
