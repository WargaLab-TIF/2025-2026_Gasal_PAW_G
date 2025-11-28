<?php
$height = array(
    "Andy" => "176",
    "Berry" => "165",
    "Charlie" => "170",
    "Jordan" => "173",
    "Asep" => "167",
    "Rahmat" => "180",
    "Azka" => "178",
    "Putri" => "160",
);

foreach($height as $x => $x_value){
    echo "Key = ".$x.", Value = ".$x_value;
    echo "<br>";
}
/* Tidak ada perubahan yang dilakukan pada perulangan foreach untuk menampilkan data 
yang sudah ditambahkan karena dari skrip sebelumnya itu bisa menampilkan data asosiatif berapapun
jadi tidak ada perubahan yang dilakukan. */

echo "<hr>";
$weight = array(
    "Udin" => "60",
    "Asep" => "67",
    "Agus" => "80",
);

foreach ($weight as $x => $x_value) {
    echo "Key = " . $x . ", Value = " . $x_value;
    echo "<br>";
}

/* Tidak saya hanya mengedit sedikit perulangan foreach yang sudah ada, saya hanya mengubah 
di bagian dalam kurung () yang awalnya $height saya ubah menjadi $weight, sesuai dengan variabel 
dari array yang ingin ditampilkan dan untuk sisanya sama. */
?>