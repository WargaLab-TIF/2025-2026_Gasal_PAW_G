<h1>3.5.1</h1>
<?php
$students = array
(
  array("Alex", "220401", "0812345678"),array("Bianca", "220402", "0812345687"),array("Candice", "220403", "0812345665")
);

// Menambahkan 5 data baru ke dalam array $students
$students[] = array("David", "220404", "0812345677");
$students[] = array("Ethan", "220405", "0812345699");
$students[] = array("Fiona", "220406", "0812345655");
$students[] = array("George", "220407", "0812345644");
$students[] = array("Hannah", "220408", "0812345633");

echo "<h3>Data Mahasiswa Setelah Ditambah</h3>";
for ($row = 0; $row < count($students); $row++) {
  echo "<p><b>Row number $row</b></p>";
  echo "<ul>";
  for ($col = 0; $col < 3; $col++) {
    echo "<li>" . $students[$row][$col] . "</li>";
  }
  echo "</ul>";
}
?>

<h1>3.5.2</h1>

<?php
$students = array
(
  array("Alex", "220401", "0812345678"),
  array("Bianca", "220402", "0812345687"),
  array("Candice", "220403", "0812345665")
);

// Menambahkan 5 data baru ke dalam array $students
$students[] = array("David", "220404", "0812345677");
$students[] = array("Ethan", "220405", "0812345699");
$students[] = array("Fiona", "220406", "0812345655");
$students[] = array("George", "220407", "0812345644");
$students[] = array("Hannah", "220408", "0812345633");


echo "<h3>Tabel Data Mahasiswa</h3>";
echo "<table border='1'>";
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
