<?php
    $matkul=["PTI","ALPRO","DPW","STRUKDAT","JARKOM","PAW","PSBF","RPL"];
    foreach($matkul as $kuliah){
        switch($kuliah){
            case "PTI":
                echo "saya suka $kuliah <br>";
                break;
            case "ALPRO":
                echo "saya suka $kuliah <br>";
                break;
            case "DPW":
                echo "saya suka $kuliah <br>";
                break;
            case "STRUKDAT":
                echo "saya suka $kuliah <br>";
                break;
            case "JARKOM":
                echo "saya suka $kuliah <br>";
                break;
            case "PAW":
                echo "saya suka $kuliah <br>";
                break;
            default:
                echo "saya tidak mengambil matkul $kuliah <br>";
                break;        
        }
    }
?>