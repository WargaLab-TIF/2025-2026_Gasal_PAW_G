<?php
//===========================//
//        3.6
//===========================//

// Data dari 3.5
$students = array(
    array("Alex", "220401", "0812345678"),
    array("Bianca", "220402", "0812345687"),
    array("Candice", "220403", "0812345655"),
    array("David", "220404", "0812345000"),
    array("Eva", "220405", "0812345111"),
    array("Fikri", "220406", "0812345222"),
    array("Gina", "220407", "0812345333"),
    array("Hana", "220408", "0812345444")
);

//===========================//
//        3.6.1 array_push()
//===========================//
echo "<h3>3.6.1 array_push()</h3>";

// Menambahkan data baru ke array students
array_push($students, array("Ian", "220409", "0812345555"));
array_push($students, array("Joko", "220410", "0812345666"));

foreach ($students as $index => $data) {
    echo "Index $index: " . implode(" | ", $data) . "<br>";
}

echo "<br>";

//===========================//
//        3.6.2 array_merge()
//===========================//
echo "<h3>3.6.2 array_merge()</h3>";

$students_baru = array(
    array("Kiki", "220411", "0812345777"),
    array("Lala", "220412", "0812345888")
);

$gabung = array_merge($students, $students_baru);

foreach ($gabung as $index => $data) {
    echo "Index $index: " . implode(" | ", $data) . "<br>";
}

echo "<br>";

//===========================//
//        3.6.3 array_values()
//===========================//
echo "<h3>3.6.3 array_values()</h3>";

$nama_mahasiswa = array();
foreach ($gabung as $item) {
    $nama_mahasiswa[] = $item[0];
}

$nama_mahasiswa = array_values($nama_mahasiswa);

foreach ($nama_mahasiswa as $i => $nama) {
    echo "Index $i: $nama<br>";
}

echo "<br>";

//===========================//
//        3.6.4 array_search()
//===========================//
echo "<h3>3.6.4 array_search()</h3>";

$cari_nama = "Eva";
$index_cari = array_search($cari_nama, $nama_mahasiswa);

if ($index_cari !== false) {
    echo "Nama '$cari_nama' ditemukan pada index $index_cari<br>";
} else {
    echo "Nama '$cari_nama' tidak ditemukan<br>";
}

echo "<br>";

//===========================//
//        3.6.5 array_filter()
//===========================//
echo "<h3>3.6.5 array_filter()</h3>";

$filtered = array_filter($gabung, function($data) {
    return $data[1] > "220405";
});

foreach ($filtered as $i => $data) {
    echo "Index $i: " . implode(" | ", $data) . "<br>";
}

echo "<br>";

//===========================//
//        3.6.6 Sorting
//===========================//
echo "<h3>3.6.6 Sorting</h3>";

$nama_sort = $nama_mahasiswa;
sort($nama_sort);

echo "Hasil sort() berdasarkan nama (A-Z):<br>";
foreach ($nama_sort as $i => $nama) {
    echo "Index $i: $nama<br>";
}

echo "<br>";

rsort($nama_sort);

echo "Hasil rsort() berdasarkan nama (Z-A):<br>";
foreach ($nama_sort as $i => $nama) {
    echo "Index $i: $nama<br>";
}

?>
