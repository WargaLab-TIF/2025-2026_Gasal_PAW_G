<?php
$height = array(
    "Andy" => "176",
    "Barry" => "165",
    "Charlie" => "170"
);

$height["David"] = "180";
$height["Ella"] = "160";
$height["Frank"] = "172";
$height["Grace"] = "168";
$height["Helen"] = "175";

echo "<h3>(Array \$height):</h3>";
foreach($height as $x => $x_value) {
    echo "Key = " . $x . ", Value = " . $x_value . " cm<br>";
}

echo "<br>Tidak perlu mengubah struktur perulangan foreach,<br>";
echo "karena foreach akan otomatis membaca seluruh elemen dalam array,<br>";
echo "tanpa perlu menentukan jumlah atau indeks elemen secara manual.<br><br>";

$weight = array(
    "Andy" => "65",
    "Barry" => "70",
    "Charlie" => "68"
);

echo "<h3>(Array \$weight):</h3>";
foreach($weight as $key => $val) {
    echo "Key = " . $key . ", Value = " . $val . " kg<br>";
}

echo "<br>Tidak perlu membuat skrip baru,<br>";
echo "cukup ubah nama variabel array yang digunakan dalam foreach.<br>";
echo "Struktur perulangan foreach tetap sama karena bekerja untuk semua array asosiatif.";
?>
