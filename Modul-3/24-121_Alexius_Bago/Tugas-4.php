<?php
$height = array("Andy" => 176, "Barry" => 165, "Charlie" => 170);
foreach ($height as $nama => $tinggi) {
    echo "Key = " . $nama . ", Value = " . $tinggi;
    echo "<br>";
}

// 3.4.1 Tambahkan 5 data baru
$height += [
    "Deni" => 175,
    "Eka" => 172,
    "Fina" => 168,
    "Gilang" => 178,
    "Hani" => 163
];

echo "<br> Seluruh data height:<br>";
foreach ($height as $nama => $tinggi) {
    echo "Key = " . $nama . ", Value = " . $tinggi;
    echo "<br>";
}
// Tidak perlu ubah loop, foreach tetap jalan

// 3.4.2 Array baru $weight
$weight = array("Andi" => 60, "Budi" => 55, "Cici" => 48);
echo "<br>Data weight:<br>";
foreach ($weight as $nama => $berat) {
    echo "Key = " . $nama . ", Value = " . $berat;
    echo "<br>";
}
// Tidak perlu ubah loop, foreach tetap jalan
?>