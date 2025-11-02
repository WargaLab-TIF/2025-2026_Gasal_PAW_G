<?php

// 3.6.1

echo "<h3>3.6.1 array_push()</h3>";

$arr1 = array("budi", "tono");
array_push($arr1, "yusup", "musalip", "bang bang");

echo "Isi array setelah array_push():<br>";
print_r($arr1);
echo "<br><br>";

// 3.6.2 

echo "<h3>3.6.2 array_merge()</h3>";

$arr2 = array("budi", "tono");
$arr3 = array("yusup", "musalip", "bang bang");
$gabung = array_merge($arr2, $arr3);

echo "Hasil penggabungan array:<br>";
print_r($gabung);
echo "<br><br>";

// 3.6.3 

echo "<h3>3.6.3 array_values()</h3>";

$data = array(
    "nama1" => "budi",
    "nama2" => "tono",
    "nama3" => "yusup",
    "nama4" => "musalip",
    "nama5" => "bang bang"
);

$nilai = array_values($data);
echo "Nilai dari array asosiatif (tanpa kunci):<br>";
print_r($nilai);
echo "<br><br>";


// 3.6.4 

echo "<h3>3.6.4 array_search()</h3>";

$nama = array("budi", "tono", "yusup", "musalip", "bang bang");
$cari = array_search("yusup", $nama);

echo "'yusup' ditemukan pada indeks ke-$cari<br><br>";

// 3.6.5 
echo "<h3>3.6.5 array_filter()</h3>";

$nama2 = array("budi", "tono", "yusup", "musalip", "bang bang");


$hasil = array_filter($nama2, function($x) {
    return strlen($x) > 4;
});

echo "Hasil array_filter (nama lebih dari 4 huruf):<br>";
print_r($hasil);
echo "<br><br>";


// 3.6.6 

echo "<h3>3.6.6 Fungsi Sorting</h3>";

$data_sort = array("budi", "tono", "yusup", "musalip", "bang bang");

// sort() 
$temp1 = $data_sort;
sort($temp1);
echo "sort() (menaik):<br>";
print_r($temp1);
echo "<br>";

// rsort() 
$temp2 = $data_sort;
rsort($temp2);
echo "rsort() (menurun):<br>";
print_r($temp2);
echo "<br>";

// asort() 
$asos = array(
    "n1" => "budi",
    "n2" => "tono",
    "n3" => "yusup",
    "n4" => "musalip",
    "n5" => "bang bang"
);
asort($asos);
echo "asort():<br>";
print_r($asos);
echo "<br>";

// ksort() 
$keysort = array(
    "n3" => "yusup",
    "n1" => "budi",
    "n2" => "tono",
    "n4" => "musalip",
    "n5" => "bang bang"
);
ksort($keysort);
echo "ksort() :<br>";
print_r($keysort);
echo "<br>";

// arsort() 
arsort($asos);
echo "arsort() :<br>";
print_r($asos);
echo "<br><br>";
?>
