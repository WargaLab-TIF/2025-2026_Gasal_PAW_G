<?php
// ===== 3.6.1 array_push() =====
$buahTropis = ["Mangga", "Pisang", "Nanas"];
array_push($buahTropis, "Pepaya", "Rambutan");
echo "Setelah menambahkan buah baru: <br>";
print_r($buahTropis);
echo "<hr>";

// ===== 3.6.2 array_merge() =====
$angkaPertama = [10, 20, 30];
$angkaKedua = [40, 50, 60];
$hasilGabung = array_merge($angkaPertama, $angkaKedua);
echo "Hasil penggabungan dua array: <br>";
print_r($hasilGabung);
echo "<hr>";

// ===== 3.6.3 array_values() =====
$mahasiswa = ["nama" => "Rafi", "umur" => 21, "jurusan" => "Informatika"];
$nilaiArray = array_values($mahasiswa);
echo "Nilai array setelah menggunakan array_values(): <br>";
print_r($nilaiArray);
echo "<hr>";

// ===== 3.6.4 array_search() =====
$penyanyi = ["Tulus", "Adele", "Bruno", "Raisa"];
echo "Nama 'Adele' berada pada indeks ke-: " . array_search("Adele", $penyanyi);
echo "<hr>";

// ===== 3.6.5 array_filter() =====
function hanyaGenap($nilai) {
    return $nilai % 2 == 0;
}
$deret = [11, 22, 35, 48, 57, 60];
$hasilGenap = array_filter($deret, "hanyaGenap");
echo "Angka genap dalam array: <br>";
print_r($hasilGenap);
echo "<hr>";

// ===== 3.6.6 Fungsi pengurutan =====

// sort()
$nomor = [9, 4, 6, 1, 8, 3, 5, 2, 7];
sort($nomor);
echo "Hasil sort(): ";
print_r($nomor);
echo "<hr>";

// rsort()
rsort($nomor);
echo "Hasil rsort(): ";
print_r($nomor);
echo "<hr>";

// asort()
$dataOrang = [
    "nama" => "Sinta",
    "umur" => 22,
    "kota" => "Bandung"
];
asort($dataOrang);
echo "Hasil asort(): ";
print_r($dataOrang);
echo "<hr>";

// ksort()
ksort($dataOrang);
echo "Hasil ksort(): ";
print_r($dataOrang);
echo "<hr>";

// arsort()
arsort($dataOrang);
echo "Hasil arsort(): ";
print_r($dataOrang);
echo "<hr>";

// krsort()
krsort($dataOrang);
echo "Hasil krsort(): ";
print_r($dataOrang);
echo "<hr>";
?>