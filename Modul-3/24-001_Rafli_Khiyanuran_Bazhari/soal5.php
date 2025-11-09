<?php
// Skrip dasar: array 2D berisi [Name, NIM, Mobile]
$students = array(
	array("Alex",   "220401", "0812345678"),
	array("Bianca", "220402", "0812345687"),
	array("Candice","220403", "0812345665")
);

for ($row = 0; $row < count($students); $row++) {
	echo "<p><b>Row number $row</b></p>";
	echo "<ul>";
	for ($col = 0; $col < 3; $col++) {
		echo "<li>".$students[$row][$col]."</li>";
	}
	echo "</ul>";
}

// 3.5.1 Tambahkan 5 data baru
$newStudents = array(
	array("Dario",   "220404", "0812345601"),
	array("Elena",   "220405", "0812345602"),
	array("Fiona",   "220406", "0812345603"),
	array("Gavin",   "220407", "0812345604"),
	array("Hector",  "220408", "0812345605")
);

$students = array_merge($students, $newStudents);

echo "<h3>Data Students setelah penambahan 5 data baru</h3>";

for ($row = 0; $row < count($students); $row++) {
	echo "<p><b>Row number $row</b></p>";
	echo "<ul>";
	for ($col = 0; $col < 3; $col++) {
		echo "<li>".$students[$row][$col]."</li>";
	}
	echo "</ul>";
}
echo "<br>";

// 3.5.2 Tampilkan data dalam bentuk tabel
echo "<h3>Data Students (Tabel)</h3>";
echo "<table border='1' cellpadding='6' cellspacing='0'>";
echo "<tr><th>Name</th><th>NIM</th><th>Mobile</th></tr>";
foreach($students as $s) {
	echo "<tr>";
	echo "<td>".$s[0]."</td>";
	echo "<td>".$s[1]."</td>";
	echo "<td>".$s[2]."</td>";
	echo "</tr>";
}
echo "</table>";
?>


