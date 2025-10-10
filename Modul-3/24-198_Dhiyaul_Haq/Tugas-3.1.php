<?php
    // Implementasi skrip
    $fruits = array("Avocado", "Blueberry", "Cherry");
    echo "I like ".$fruits[0].", ".$fruits[1]." and ".$fruits[2].".";
    
    // 3.1.1 (Menambahkan 5 data baru dan menampilkan indeks tertinggi)
    echo "<hr>";
    array_push($fruits, "Pineapple", "Banana", "Strawberry", "Mango", "Apple");
    echo "Indeks tertinggi adalah ".$fruits[count($fruits) - 1]." dengan indeks ke - ".count($fruits) - 1;

    // 3.1.2 (Menghapus 1 data pada array, lalu ditampilkan nilai tertinggi)
    echo "<hr>";
    array_splice($fruits, 2, 1);
    echo "Indeks tertinggi adalah ".$fruits[count($fruits) - 1]." dengan indeks ke - ".count($fruits) - 1;
    
    // 3.1.3 (Membuat array baru (memiliki 3 data) lalu ditampilkan semua)
    echo "<hr>";
    $veggies = ["Broccoli", "Carrot", "Tomato"];
    foreach($veggies as $num => $v) {
        echo ++$num.". ".$v."<br>";
    };
?>