<?php
    // Implementasi skrip
    $height = array("Andy" => "176", "Barry" => "165", "Charlie" => "170");

    foreach($height as $x => $x_value) {
        echo "Key= ".$x." , Value= ".$x_value;
        echo "<br>";
    }

    // 3.4.1 (Tambhkan 5 data baru)
    echo "<hr>";
    $height += ["Marry" => "159", "Dony" => "160", "Benny" => "155", "Owen" => "171", "Harlan" => "180"];
    foreach($height as $x => $x_value) {
        echo "Key= ".$x." , Value= ".$x_value;
        echo "<br>";
    }

    // 3.4.2 (Buat array baru yang memiliki 3 data)
    echo "<hr>"; 
    $weight = ["Moon" => 150, "Earth" => 180, "Jupyter" => 100];
    foreach($weight as $x => $x_value) {
        echo "Key= ".$x." , Value= ".$x_value;
        echo "<br>";
    }
?>