<?php
$students = array
(
    array("Alex", "220401", "0812345678"),
    array("Bianca", "220402", "0812345687"),
    array("Candice", "220403", "0812345665")
);

for ($row = 0; $row < 3; $row++) {
    echo "<p><b>Row number $row</b></p>";
    echo "<ul>";
    for ($col = 0; $col < 3; $col++) {
        echo "<li>".$students[$row][$col]."</li>";
    }
    echo "</ul>";
}

// 3.5.1 Tambah 5 data baru
array_push($students,
    ["Daniel", "220404", "0812345699"],
    ["Erika", "220405", "0812345670"],
    ["Farhan", "220406", "0812345621"],
    ["Gita", "220407", "0812345691"],
    ["Hendra", "220408", "0812345642"]
);

// 3.5.2 Tampilkan dalam bentuk tabel
echo "<table border='1' cellpadding='5'>";
echo "<tr><th>Name</th><th>NIM</th><th>Mobile</th></tr>";
foreach ($students as $s) {
    echo "<tr>";
    for ($i = 0; $i < count($s); $i++) {
        echo "<td>" . $s[$i] . "</td>";
    }
    echo "</tr>";
}
echo "</table>";
?>