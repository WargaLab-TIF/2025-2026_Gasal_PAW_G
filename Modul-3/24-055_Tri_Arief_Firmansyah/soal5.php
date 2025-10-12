<?php
$students = [
    ["Name" => "Alex", "NIM" => "220401", "Mobile" => "0812345678"],
    ["Name" => "Bianca", "NIM" => "220402", "Mobile" => "0812345687"],
    ["Name" => "Candice", "NIM" => "220403", "Mobile" => "0812345665"],
];

// 3.5.1 Tambahkan 5 data baru
array_push(
    $students,
    ["Name" => "Raga", "NIM" => "220404", "Mobile" => "0812345679"],
    ["Name" => "Nanda", "NIM" => "220405", "Mobile" => "0812345680"],
    ["Name" => "Helmi", "NIM" => "220406", "Mobile" => "0812345681"],
    ["Name" => "Riko", "NIM" => "220407", "Mobile" => "0812345682"],
    ["Name" => "Hanip", "NIM" => "220408", "Mobile" => "0812345683"]
);

// 3.5.2 Tampilkan data dalam bentuk tabel
echo "<h3>3.5.1 & 3.5.2 Data Students</h3>";
echo "<table border='1' cellpadding='5'>";
echo "<tr><th>Name</th><th>NIM</th><th>Mobile</th></tr>";
foreach ($students as $s) {
    echo "<tr><td>{$s['Name']}</td><td>{$s['NIM']}</td><td>{$s['Mobile']}</td></tr>";
}
echo "</table>";
?>
