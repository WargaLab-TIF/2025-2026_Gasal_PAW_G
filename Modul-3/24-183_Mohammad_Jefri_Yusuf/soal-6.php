<?php 
// 3.6.1
$buah = ["Apel","Semangka","Jeruk"];
array_push($buah,"Kiwi","Alpukat");
print_r($buah);
echo "<hr>";

// 3.6.2
$array1 = [1,2,3,4];
$array2 = [5,6,7];
$array3 = array_merge($array1,$array2);
print_r($array3);
echo "<hr>";

// 3.6.3
$profil = ["nama" => "Jefri", "umur" => "19", "fakultas" => "teknik"];
$profileBaru = array_values($profil);
print_r($profileBaru);
echo "<hr>";

// 3.6.4
    $daftar_musisi = ["heiakim","porter","robinson","rain"];
    echo "heiakim berada di indeks: ". array_search("heiakim",$daftar_musisi);
    echo "<hr>";

// 3.6.5
function angkaGenap($angka) {
    return $angka % 2 == 0;
}
$angka = [1,2,4,6,5,7,8];
$angkaGenapBaru = array_filter($angka, "angkaGenap");
print_r($angkaGenapBaru);
echo "<hr>";

// 3.6.6
// sort()
$numbers = [5,5,3,6,8,2,1,4,7,0];
sort($numbers);
echo "sort(): ";
print_r($numbers);
echo "<hr>";

// rsort()
rsort($numbers);
echo "rsort(): ";
print_r($numbers);
echo "<hr>";

//asort()
$profil = [ 
    "nama" => "Jordan",
    "umur" => "21",
    "kota" => "Los Angeles"
];

asort($profil);
echo "asort(): ";
print_r($profil);
echo "<hr>";

// ksort()
ksort($profil);
echo "ksort(): ";
print_r($profil);
echo "<hr>";

// arsort()
arsort($profil);
echo "arsort(): ";
print_r($profil);
echo "<hr>";

// krsort()
krsort($profil);
echo "krsort(): ";
print_r($profil);
?>