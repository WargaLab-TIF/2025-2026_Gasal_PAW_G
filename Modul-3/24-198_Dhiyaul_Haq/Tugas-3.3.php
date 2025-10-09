<?php
    // Implementasi skrip
    $height = array("Andy" => "176", "Barry" => "165", "Charlie" => "170");
    echo "Andy is ".$height["Andy"]."cm tall.";

    // 3.3.1 (Tambahkan 5 data baru lalu tampilkan nilai dengan indeks paling akhir)
    echo "<hr>";
    $height += ["Marry" => "159", "Dony" => "160", "Benny" => "155", "Owen" => "171", "Harlan" => "180"];
    $counter = 0;
    foreach($height as $name => $h) {
        if ($counter == count($height) - 1) {
            echo $name." dengan tinggi ".$h."cm berada pada index ".$counter;
        }
        $counter++;
    };

    // 3.3.2 (Hapus data pada array, tampilkan dengan indeks terakhir)
    echo "<hr>";
    unset($height["Benny"]);
    $counter = 0;
    foreach($height as $name => $h) {
        if ($counter == count($height) - 1) {
            echo $name." dengan tinggi ".$h."cm berada pada index ".$counter;
        }
        $counter++;
    };

    // 3.3.3 (Buat array baru dengan 3 data, lalu tampilkan data ke - 2)
    echo "<hr>";
    $weight = ["Moon" => 150, "Earth" => 180, "Jupyter" => 100];
    echo "Moon dengan berat ".$weight["Moon"]."kg";
?>