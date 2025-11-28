<?php
$angka = 0;

do {
    if ($angka % 4 == 0 && $angka != 0) {
        echo $angka . "<br>";
    }
    $angka++;
} while ($angka <= 20);
?>