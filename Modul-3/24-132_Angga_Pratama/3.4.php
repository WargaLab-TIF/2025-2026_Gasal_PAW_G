<?php
echo "## Jawaban 3.4.1\n\n";
$height = ["Andy" => "176", "Supri" => "165", "Priyo" => "170"];

$height["David"] = "180";
$height["Angga"] = "172";
$height["Adit"] = "168";
$height["Iwan"] = "175";
$height["Aan"] = "182";

echo "Seluruh data dalam array \$height:<br>";
foreach ($height as $key => $value) {
    echo "Key=" . $key . ", Value=" . $value . "<br>";
}

echo "<br><b>Penjelasan Pertanyaan:</b><br>";
echo "<b>Apakah Anda perlu melakukan perubahan pada skrip perulangan?</b><br>";
echo "Tidak, tidak perlu ada perubahan sama sekali pada struktur perulangan `foreach`.<br><br>";
echo "<b>Mengapa demikian?</b><br>";
echo "Struktur perulangan `foreach` secara otomatis dirancang untuk mengiterasi (menelusuri) seluruh elemen dalam sebuah array, dari awal hingga akhir, terlepas dari jumlah datanya. Jadi, meskipun 5 data baru ditambahkan, `foreach` akan tetap menampilkan semua elemen tanpa perlu modifikasi pada kodenya.<br>";
echo "<hr>";
echo "## Jawaban 3.4.2\n\n";

$weight = ["Andy" => 68, "Supri" => 60, "Priyo" => 65];
echo "Seluruh data dalam array \$weight:<br>";
foreach ($weight as $nama => $berat) {
    echo "Key=" . $nama . ", Value=" . $berat . "<br>";
}

echo "<br><b>Penjelasan Pertanyaan:</b><br>";
echo "<b>Apakah Anda membuat skrip baru atau memodifikasi?</b><br>";
echo "Cukup memodifikasi skrip yang sudah ada.<br><br>";
echo "<b>Mengapa demikian?</b><br>";
echo "Sama seperti `for` loop, logika `foreach` bersifat generik. Kita hanya perlu mengganti nama variabel array yang diiterasi (dari '\$height' menjadi '\$weight') dan bisa juga mengubah nama variabel untuk key dan value agar lebih deskriptif, meskipun tidak wajib.";
?>