<?php
echo "<h2>Jawaban 3.5.1 dan 3.5.2</h2>";

$students = [
    ["Budi", "220401", "0812345678"],
    ["Citra", "220402", "0812345687"],
    ["Dewi", "220403", "0812345665"],
];

$students[] = ["Eko", "220404", "0812345611"];
$students[] = ["Fajar", "220405", "0812345622"];
$students[] = ["Gita", "220406", "0812345633"];
$students[] = ["Heru", "220407", "0812345644"];
$students[] = ["Indah", "220408", "0812345655"];

echo "<p>Lima data baru dengan nama Indonesia telah berhasil ditambahkan.</p>";

echo "<h3>Tabel Data Mahasiswa</h3>";
echo "<table border='1' cellpadding='10' cellspacing='0'>";

echo "<thead>";
echo "<tr>";
echo "<th>Nama</th>";
echo "<th>NIM</th>";
echo "<th>Mobile</th>";
echo "</tr>";
echo "</thead>";

echo "<tbody>";
for ($row = 0; $row < count($students); $row++) {
    echo "<tr>";
    for ($col = 0; $col < count($students[$row]); $col++) {
        echo "<td>" . $students[$row][$col] . "</td>";
    }
    echo "</tr>";
}
echo "</tbody>";
echo "</table>";

?>