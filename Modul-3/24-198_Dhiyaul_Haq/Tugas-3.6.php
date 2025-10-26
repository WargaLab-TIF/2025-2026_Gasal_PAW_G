<?php
    // 3.6.1 (Implementasi fungsi array_push)
    $color = ["red", "green", "yellow"];
    array_push($color, "black", "purple");
    
    foreach($color as $col) {
        echo $col.", ";
    }

    // 3.6.2 (Implementasi fungsi array_merge)
    echo "<hr>";
    $color2 = ["pink", "teal"];
    $color3 = array_merge($color, $color2);
    
    foreach($color3 as $col) {
        echo $col.", ";
    }

    // 3.6.3 (Implementasi fungci array_values)
    echo "<hr>";
    $car = ["Mercedes" => "AMG", "BMW" => "M3", "Nissan" => "Nismo", "Subaru" => "STI", "Mazda" => "MPS"];
    $value = (array_values($car));
    
    foreach($value as $col) {
        echo $col.", ";
    }

    // 3.6.4 (Implementasi fungsi array_search)
    echo "<hr>";
    echo array_search("AMG", $car)." ditemukan <br>"; 
    echo array_search("RS", $car)." tidak ditemukan <br>";

    // 3.6.5 (Implementasi fungsi array_filter)
    echo "<hr>";
    $nums = [1, 8, 2, 9, 7, 6, 0, 3];
    function number($num) {
        return($num < 5);
    }
    
    $filter = array_filter($nums, "number");
    foreach($filter as $col) {
        echo $col.", ";
    }

    // 3.6.6 (Implementasi fungsi sorting)
    // Ascending (kecil ke besar)
    echo "<hr>";
    echo "fungsi sort()<br>";
    sort($nums);
    foreach($nums as $col) {
        echo $col.", ";
    }
    // Descending (besar ke kecil)
    echo "<br><br>fungsi rsort()<br>";
    rsort($nums);
    foreach($nums as $col) {
        echo $col.", ";
    }
    // Ascending (hanya mengurutkan value)
    echo "<br><br>fungsi asort()<br>";
    asort($car);
    foreach($car as $col => $cp) {
        echo $col." = ".$cp."<br>";
    }
    // Ascending (hanya mengurutkan key)
    echo "<br>fungsi ksort()<br>";
    ksort($car);
    foreach($car as $col => $cp) {
        echo $col." = ".$cp."<br>";
    }
    // Descending (hanya mengurutkan value)
    echo "<br>fungsi arsort()<br>";
    arsort($car);
    foreach($car as $col => $cp) {
        echo $col." = ".$cp."<br>";
    }
    // Descending (hanya mengurutkan key)
    echo "<br>fungsi arsort()<br>";
    krsort($car);
    foreach($car as $col => $cp) {
        echo $col." = ".$cp."<br>";
    }
?>