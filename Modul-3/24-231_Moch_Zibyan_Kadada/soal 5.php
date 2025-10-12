<?php 
$student = array(
    array("Alex", "220401", "0812345678"),
    array("Bianca", "220402", "0812345687"),
    array("Candice", "220403", "0812345665")
);
for($row = 0; $row < 3; $row++) {
    echo "<p><b>Row number $row</p></b>";
    echo "<ul>";
    for ($col = 0; $col < 3; $col++){
        echo "<li>".$student[$row][$col]."</li>";

    }
    echo "</ul>";
}
echo "<hr>";

// 3.5.1
$student[] = ["Biyan", "220215", "0812345611"];
$student[] = ["Bima", "2404119", "0812345622"];
$student[] = ["Hakim", "230314", "0812345633"];
$student[] = ["Wowok", "240411", "0812345644"];
$student[] = ["Yanto", "220408", "0812345655"];

for($row = 0; $row < count($student); $row++) {
    echo "<p><b>Row number $row</p></b>";
    echo "<ul>";
    for ($col = 0; $col < 3; $col++){
        echo "<li>".$student[$row][$col]."</li>";

    }
    echo "</ul>";
}
echo "<hr>";

// 3.5.2
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Mahasiswa</title>
</head>
<body>
    <table border="1" cellpadding="7" cellspacing ="0">
        <tr>
            <th>Nama</th>
            <th>NIM</th>
            <th>Nomer HP</th>
        </tr>
        <?php for($row = 0; $row < count($student); $row++): ?>
            <tr>
                <?php for($col = 0; $col < count($student[$row]); $col++): ?>
                    <td><?= $student[$row][$col]; ?></td>
                <?php endfor; ?>
            </tr>
        <?php endfor; ?>
            
    </table>
</body>
</html>