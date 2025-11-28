<?php
echo "<h2>3.5. Array Multidimensi</h2>";

// Deklarasi array multidimensi
$students = array(
    array("Alex", "220401", "0812345678"),
    array("Bianca", "220402", "0812345687"),
    array("Candice", "220403", "0812345665")
);

// 3.5.1. Tambah 5 data baru
echo "<h3>3.5.1. Tambah 5 Data Baru</h3>";
$students[] = array("David", "220404", "0812345633");
$students[] = array("Eva", "220405", "0812345622");
$students[] = array("Frank", "220406", "0812345611");
$students[] = array("Grace", "220407", "0812345600");
$students[] = array("Henry", "220408", "0812345599");

// 3.5.2. Tampilkan dalam bentuk tabel
echo "<h3>3.5.2. Tampil dalam Tabel</h3>";
echo "<table border='1' cellpadding='5' cellspacing='0'>";
echo "<tr><th>Name</th><th>NIM</th><th>Mobile</th></tr>";

foreach ($students as $student) {
    echo "<tr>";
    foreach ($student as $data) {
        echo "<td>$data</td>";
    }
    echo "</tr>";
}
echo "</table>";
?>