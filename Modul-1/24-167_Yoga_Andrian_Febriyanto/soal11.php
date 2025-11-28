<?php
    $kalimat="Hello World!";
    $kata ="World";
    $posisi=strpos($kalimat,$kata);
    if ($posisi !== false) {
        echo $posisi;
    } else {
        echo "Kata tidak ditemukan";
    }
?>