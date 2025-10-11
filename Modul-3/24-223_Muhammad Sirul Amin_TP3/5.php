<?php

$students = array(
  array("Alex", "220401", "0812345678"),
  array("Bianca", "220402", "0812345687"),
  array("Candice", "220403", "0812345697")
);

// manbah 3 data baru ke array $students
// untuk nomernya izin 
$students[] = array("Riski", "220404", "0871111111");
$students[] = array("Ivanka", "220405", "0871111111");
$students[] = array("Budi", "220406", "0871111111");

// untuk tabelnya
echo "<table border='2' cellpadding='5' cellspacing='0'>";
echo "<tr><th>Name</th><th>NIM</th><th>Mobile</th></tr>";

for ($row = 0; $row < count($students); $row++) {
  echo "<tr>";
  for ($col = 0; $col < 3; $col++) {
    echo "<td>" . $students[$row][$col] . "</td>";
  }
  echo "</tr>";
}

echo "</table>";
?>
