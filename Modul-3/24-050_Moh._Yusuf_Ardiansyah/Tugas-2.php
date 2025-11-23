<?php
$fruits = array("Avocado", "Blueberry", "Cherry");
$arrlength = count($fruits);

for ($x = 0; $x < $arrlength; $x++) {
    echo $fruits[$x];
    echo "<br>";
}
echo "<br>";

// 3.2.1
$data_baru = ["Apple", "Melon", "Banana", "Grape", "Orange"];
for ($i = 0; $i < count($data_baru); $i++) {
    $fruits[] = $data_baru[$i];
}
for ($x = 0; $x < count($fruits); $x++) {
    echo $fruits[$x] . "<br>";
}
echo "<br>";
// Pertanyaan:
// Berapa panjang (jumlah data) array $fruits saat ini? Apakah Anda
// perlu melakukan perubahan pada skrip penggunaan struktur perulangan
// FOR (skrip baris 5 – 8) untuk menampilkan seluruh data dalam array
// $fruits dengan adanya penambahan 5 data baru? Mengapa demikian?
// Jelaskan!

// Jawaban:
// Panjang array $fruits saat ini adalah 8 (3 data lama + 5 data baru).
// iya, skrip perulangan FOR perlu diubah.
// karena kondisi perulangan `for` yang lama menggunakan variabel `$arrlength`
// yang nilainya sudah ditetapkan (yaitu 3) sebelum array diperbarui.
// Agar bisa menampilkan semua data, kondisi perulangan harus menggunakan `count($fruits)`
// untuk mendapatkan jumlah data yang terkini.

// 3.2.2
$veggies = array("Carrot", "Potato", "Broccoli");
for ($i = 0; $i < count($veggies); $i++) {
    echo $veggies[$i] . "<br>";
}
// Pertanyaan:
// Apakah Anda membuat skrip baru untuk menampilkan
// seluruh array $veggies ataukah Anda cukup sedikit memodifikasi skrip
// yang sudah ada? Mengapa demikian? Jelaskan!

// Jawaban:
// Iya, saya membuat skrip perulangan FOR yang baru.
// Alasannya adalah karena perulangan harus secara spesifik mengakses variabel `$veggies`.
// Perulangan yang ada sebelumnya dirancang untuk variabel `$fruits` dan tidak bisa
// digunakan untuk menampilkan isi dari `$veggies` tanpa diubah referensi variabelnya.
// Struktur logikanya mirip, tetapi implementasinya harus baru untuk array yang berbeda.
?>