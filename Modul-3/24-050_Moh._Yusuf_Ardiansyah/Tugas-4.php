<?php
$height = array("Andy" => 176, "Barry" => 165, "Charlie" => 170);

foreach ($height as $x => $x_value) {
    echo "Key=" . $x . ", Value=" . $x_value;
    echo "<br>";
}
echo "<br>";

// 3.4.1
$height['Kairi'] = 172;
$height['Sanz'] = 175;
$height['Lutpi'] = 170;
$height['Kiboy'] = 169;
$height['Skylar'] = 180;

foreach ($height as $x => $x_value) {
    echo "Key=" . $x . ", Value=" . $x_value;
    echo "<br>";
}
echo "<br>";
// Pertanyaan:
// Apakah Anda perlu
// melakukan perubahan pada skrip penggunaan struktur perulangan FOR
// (skrip baris 4 – 7) untuk menampilkan seluruh data dalam array $height
// dengan adanya penambahan 5 data baru? Mengapa demikian? Jelaskan!

// Jawaban:
// Tidak, skrip perulangan FOREACH tidak perlu diubah sama sekali.
// karena `foreach` dirancang untuk secara otomatis memproses
// seluruh elemen yang ada di dalam sebuah array, tidak peduli berapa pun jumlahnya.
// Ia akan selalu memeriksa jumlah data terkini setiap kali dijalankan.

// 3.4.2
$weight = array("Kairi" => 70, "Skylar" => 60, "Kiboy" => 56);
$keys = array_keys($weight);
$values = array_values($weight);

for ($i = 0; $i < count($weight); $i++) {
    echo "Key=" . $keys[$i] . ", Value=" . $values[$i] . "<br>";
}
// Pertanyaan:
// Apakah Anda membuat skrip baru untuk menampilkan
// seluruh array $weight ataukah Anda cukup sedikit memodifikasi skrip yang
// sudah ada? Mengapa demikian? Jelaskan!

// Jawaban:
// Iya,saya membuat skrip perulangan FOR yang baru.
// karena perulangan `for` untuk array asosiatif memerlukan
// logika yang berbeda dibandingkan `foreach`. Kita harus mengekstrak `keys` dan `values`
// menjadi array terindeks terlebih dahulu. Selain itu, skrip baru ini juga harus
// merujuk secara spesifik ke variabel `$weight` dan menghitung jumlah datanya,
// sehingga tidak bisa hanya memodifikasi skrip dari array `$height` sebelumnya.
?>