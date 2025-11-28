<?php
// Data awal
$data = array("Dewi", "Geizya");

echo "Data awal:<br>";
foreach ($data as $item) {
    echo "$item<br>";
}

echo "<br>";

// 3.6.1 Array_push()
$tambah = $data;
array_push($tambah, "Dew", "Degez", "Degesy");
echo "Setelah array_push():<br>";
foreach ($tambah as $nama) {
    echo "$nama<br>";
}
echo "<br>";

// 3.6.2 Array_Merge()
$baru = array("Mie ayam", "Seblak", "Martabak manis");
$gabung = array_merge($tambah, $baru);
echo "Setelah array_merge() (gabung dengan array baru):<br>";
foreach ($gabung as $nama) {
    echo "$nama<br>";
}
echo "<br>";

// 3.6.3 Array_Values()
$nilai = array_values($gabung);
echo "Setelah array_values():<br>";
foreach ($nilai as $nama) {
    echo "$nama<br>";
}
echo "<br>";

// 3.6.4 Array_Search()
$cari = array_search("Geizya", $nilai);
if ($cari !== false) {
    echo " Hasil array_search('Geizya'): Index ke-$cari<br>";
} else {
    echo " 'Geizya' tidak ditemukan<br>";
}

echo "<br>";

// 3.6.5 Array_Filter()
$filter = array_filter($nilai, function($bebas) {
    return strlen($bebas) > 5;
});
echo "Setelah array_filter() (panjang > 5 huruf):<br>";
foreach ($filter as $nama) {
    echo "$nama<br>";
}
echo "<br>";

// 3.6.6 Sorting
$urutAZ = $nilai;
sort($urutAZ);
echo "Setelah sort() (A-Z):<br>";
foreach ($urutAZ as $nama) {
    echo "$nama<br>";
}
echo "<br>";

$urutZA = $nilai;
rsort($urutZA);
echo "stelah rsort() (Z-A):<br>";
foreach ($urutZA as $nama) {
    echo "$nama<br>";
}
?>
