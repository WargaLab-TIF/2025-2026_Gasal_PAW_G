<?php
$height = array(
  "Andy" => "176",
  "Barry" => "165",
  "Charlie" => "170"
);

// dta baru ke array
$height["David"] = "180";
$height["Ella"] = "160";
$height["Frank"] = "175";
$height["Grace"] = "162";
$height["Henry"] = "185";

// untuk menampilkan semua data tinggi badan
echo "<h4>Data Tinggi Badan</h4>";
foreach ($height as $x => $x_value) {
  echo "Key = " . $x . ", Value = " . $x_value;
  echo "<br>";
}

//array baru untuk berat badan
$weight = array(
  "Andy" => "65",
  "Barry" => "72",
  "Charlie" => "68"
);

// Menampilkan semua data berat badan
echo "<h4>Data Berat Badan</h4>";
foreach ($weight as $key => $value) {
  echo "Key = " . $key . ", Value = " . $value;
  echo "<br>";
}
?>
