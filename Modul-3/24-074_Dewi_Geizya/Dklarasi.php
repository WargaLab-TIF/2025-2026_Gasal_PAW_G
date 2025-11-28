<?php
$students = array( array("Alex","220401","0812345678"), array("Bianca","220402","0812345687"), array("Candice","220403","0812345665"),
);
array_push($students, array("Dewi", "241176", "0898705411"),
array("Geizya", "247689", "0812345432"), array("Dewdew", "187432",
"0821344321"),
array("Bintang", "321098", "0832145654"), array("Cika", "412109",
"0855660789"));
echo "<table border='1' cellpadding='5'>";
echo "<tr><th>Name</th><th>NIM</th><th>Mobile</th></tr>"; for ($row = 0; $row < count($students); $row++) {
echo "<tr>";
for ($col = 0; $col < 3; $col++) {
echo "<td>".$students[$row][$col]."</td>";
}
echo "</tr>";
}
echo "</table>";
?>