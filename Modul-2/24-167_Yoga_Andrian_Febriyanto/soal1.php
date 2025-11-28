<?php
    $matkul =["PTI","ALPRO","DPW","STRUKDAT","JARKOM","PAW","PSBF","RPL"];
    $praktikum=["JARKOM","PAW"];
    for ($x=0;$x<count($matkul);$x++){
        if (in_array($matkul[$x],$praktikum)){
            echo "saya sedang mengambil matkul $matkul[$x] termasuk praktikumnya <br>";

        }elseif ($matkul[$x]=="PSBF" || $matkul[$x]=="RPL") {
           echo "saya belum mengambil matkul $matkul[$x] <br>";
        } else {
            echo "saya sudah mengambil matkul $matkul[$x] semester lalu <br>";
        }
        
    }
?>