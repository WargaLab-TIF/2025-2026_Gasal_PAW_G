<?php
//soal 9

function hitungJumlahKata($inputString) {
    $jumlahKata = str_word_count($inputString);
    echo $jumlahKata;
}

$string = "Hello world!";
hitungJumlahKata($string);
?>
