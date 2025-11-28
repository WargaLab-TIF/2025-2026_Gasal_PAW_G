<?php 
$students = array(
    array("Alex", "220401", "0812345678"),
    array("Bianca", "220402", "0812345687"),
    array("Candice", "220403", "0812345665")
);
for($row = 0; $row < 3; $row++) {
    echo "<p><b>Row number $row</p></b>";
    echo "<ul>";
    for ($col = 0; $col < 3; $col++){
        echo "<li>".$students[$row][$col]."</li>";

    }
    echo "</ul>";
}
echo "<hr>";

// 3.5.1
$students[] = ["Jefri","220404","0812345666"];
$students[] = ["Lewis","220405","0812345667"];
$students[] = ["Fuzuka","220406","0812345668"];
$students[] = ["Jordan","220407","0812345669"];
$students[] = ["Edward","220408","0812345670"];

for($row = 0; $row < count($students); $row++) {
    echo "<p><b>Row number $row</p></b>";
    echo "<ul>";
    for ($col = 0; $col < count($students[0]); $col++){
        echo "<li>".$students[$row][$col]."</li>";

    }
    echo "</ul>";
}
echo "<hr>";


?>

<!-- 3.5.2 -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Tabel Mahasiswa</title>
</head>
<body>
    <table border="1" cellpadding="5" cellspacing ="0">
        <tr>
            <th>Nama</th>
            <th>NIM</th>
            <th>Mobile</th>
        </tr>
        <?php for($row = 0; $row < count($students); $row++): ?>
            <tr>
                <?php for($col = 0; $col < count($students[0]); $col++): ?>
                    <td><?= $students[$row][$col]; ?></td>
                <?php endfor; ?>
            </tr>
        <?php endfor; ?>
            
    </table>
</body>
</html>