<?php
$students = array
  (
    array("Alex", "220401", "0812345678"),
    array("Bianca", "220402", "0812345687"),
    array("Candice", "220403", "0812345665"),
  );

for ($row = 0; $row < 3; $row++) {
  echo "<p><b>Row number $row</b></p>";
  echo "<ul>";
  for ($col = 0; $col < 3; $col++) {
    echo "<li>" . $students[$row][$col] . "</li>";
  }
  echo "</ul>";
}
// 3.5.1
$students[] = array("Kairi", "220404", "0812345611");
$students[] = array("Sanz", "220405", "0812345622");
$students[] = array("Kiboy", "220406", "0812345633");
$students[] = array("Lutpi", "220407", "0812345644");
$students[] = array("Skylar", "220408", "0812345655");

// 3.5.2
echo "<table border='1'>";
echo "<tr>";
echo "<th>Name</th>";
echo "<th>NIM</th>";
echo "<th>Mobile</th>";
echo "</tr>";

foreach ($students as $student) {
    echo "<tr>";
    foreach ($student as $data) {
        echo "<td>" . $data . "</td>";
    }
    echo "</tr>";
}

echo "</table>";
?>