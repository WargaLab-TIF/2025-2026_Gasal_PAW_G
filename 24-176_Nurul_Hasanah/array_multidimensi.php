<?php
$students = [
    ["Nurul", "240411", "0812345678"],
    ["Anis", "240412", "0812345678"],
    ["Tika", "240413", "0812345665"]
];

// Menambah 5 data baru
array_push(
    $students,
    ["Saskia", "240414", "0812345600"],
    ["Matus", "240415", "0812345611"],
    ["Haikal", "240416", "0812345622"],
    ["Dimas", "240417", "0812345633"],
    ["Rizky", "240418", "0812345644"]
);

// Menampilkan dalam bentuk tabel
echo "<table border='1' cellpadding= '5'>";
echo "<tr><th>Nama</th><th>NIM</th><th>No.Hp</th></tr>";
foreach ($students as $s){
    echo "<tr><td>$s[0]</td><td>$s[1]</td><td>$s[2]</td></tr>";
}
echo "</table>"
?>