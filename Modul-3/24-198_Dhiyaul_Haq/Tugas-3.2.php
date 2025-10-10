<?php
    // Implementasi skrip 
    $fruits = array("Avocado", "Blueberry", "Cherry");
    
    $arrlength = count($fruits);
    for($x = 0; $x < $arrlength; $x++) {
        echo $fruits[$x];
        echo "<br>";
    }

    // 3.2.1 (Tambahkan 5 data baru menggunakan perulangan for)
    echo "<hr>";
    $fruits2 = ["Pineapple", "Banana", "Strawberry", "Mango", "Apple"];
    for($i = 0; $i < count($fruits2); $i++) {
        $fruits[] = $fruits2[$i];
    };
    
    $arrlength = count($fruits);
    echo "Panjang data saat ini: $arrlength <br>";
    for($x = 0; $x < $arrlength; $x++) {
        echo $fruits[$x];
        echo "<br>";
    }

    // 3.2.2 (Buat array baru dengan 3 buah data, tampilkan datanya menggunakan perulangan for)
    echo "<hr>";
    $veggies = ["Broccoli", "Carrot", "Tomato"];

    $arrlength = count($veggies);
    for($x = 0; $x < $arrlength; $x++) {
        echo $veggies[$x];
        echo "<br>";
    }
?>