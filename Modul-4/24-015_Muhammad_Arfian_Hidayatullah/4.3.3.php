<?php

// 1. Regular expressions. Contoh: pregmatch

$nama = "Arfian";
if (preg_match("/^[a-zA-Z]+$/", $nama)) {
    echo "Valid: hanya berisi huruf.<br>";
} else {
    echo "Invalid: mengandung karakter non-huruf.<br>";
}

echo '<br><br>';

// 2. String. Contoh: trim, strtolower, strtoupper
$input = "   Halo Dunia   ";
echo trim($input) . "<br>";
echo strtolower("HELLO") . "<br>";
echo strtoupper("selamat") . "<br>";

echo '<br><br>';

// 3. Filter. Contoh: filter_var, filter_input, FILTER_VALIDATE_EMAIL,FILTER_VALIDATE_URL, FILTER_VALIDATE_FLOAT, FILTER_VALIDATE_IP
$email = "tes@gmail.com";
$url = "https://www.google.com";
$angka = "123.45";

if (filter_var($email, FILTER_VALIDATE_EMAIL))
    echo "Email valid.<br>";
else
    echo "Email tidak valid.<br>";

if (filter_var($url, FILTER_VALIDATE_URL))
    echo "URL valid.<br>";

if (filter_var($angka, FILTER_VALIDATE_FLOAT))
    echo "Angka bertipe float.<br>";

echo '<br><br>';

// 4. Type testing. Contoh: is_float, is_int, is_numeric, is_string
$nilai = 100;

if (is_int($nilai)) echo "Tipe data integer.<br>";
if (is_numeric($nilai)) echo "Nilai berupa angka.<br>";

$teks = "Halo";
if (is_string($teks)) echo "Tipe data string.<br>";

echo '<br><br>';

// 5. Date. Contoh: checkdate
$tanggal = 29;
$bulan = 2;
$tahun = 2025;

if (checkdate($bulan, $tanggal, $tahun)) {
    echo "Tanggal valid.<br>";
} else {
    echo "Tanggal tidak valid.<br>";
}

?>