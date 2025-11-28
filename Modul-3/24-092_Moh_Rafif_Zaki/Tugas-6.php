<?php
//array_push()
$buah = array("apel","pisang");
array_push($buah,"melon");
print_r($buah);
array_push($buah,array("merah","kuning","hijau"));
echo "<br>";
print_r($buah);
/* Hanya bisa dilakukan pada array terindeks dan array multidimensi */
echo "<hr>";

//array_merge()
$warna = array("merah","kuning","hijau");
$buah = array("apel","pisang","melon");
$gabung = array_merge($warna,$buah);
print_r($gabung);
echo "<br>";
echo "<br>";
$warna_buah = array(
    "merah" => "apel",
    "kuning" => "pisang",
    "hijau" => "melon"
);
$hewan = array(
    "kucing" => "darat",
    "ikan" => "air",
    "burung" => "udara"
);
$gabung = array_merge($warna_buah,$hewan);
print_r($gabung);
echo "<br>";
echo "<br>";
$warna_buah = array(
    array("merah","apel"),
    array("kuning","pisang"),
    array("hijau","melon")
);
$hewan = array(
    array("kucing","darat"),
    array("ikan","air"),
    array("burung","udara")
);
$gabung = array_merge($warna_buah,$hewan);
print_r($gabung);
/* Bisa dilakukan di array terindeks, array asosiatif, dan array multidimensi */
echo "<hr>";

//array_values()
$warna = array("merah", "kuning", "hijau");
$nilai = array_values($warna);
print_r($nilai);
echo "<br>";
echo "<br>";
$warna_buah = array(
    "merah" => "apel",
    "kuning" => "pisang",
    "hijau" => "melon"
);
$nilai = array_values($warna_buah);
print_r($nilai);
echo "<br>";
echo "<br>";
$hewan = array(
    array("kucing", "darat"),
    array("ikan", "air"),
    array("burung", "udara")
);
$nilai = array_values($hewan);
print_r($nilai);
/* Hanya bisa digunakan di array asosiatif jika digunakan di array lain juga bisa namun outputnya
sama saja dengan isi yang ada pada variabel arraynya */
echo "<hr>";

//array_search
$warna = array("merah", "kuning", "hijau");
$cari = array_search("hijau",$warna);
echo $cari;
echo "<br>";
echo "<br>";
$warna_buah = array(
    "merah" => "apel",
    "kuning" => "pisang",
    "hijau" => "melon",
    "jumlah" => 3
);
$cari = array_search("pisang",$warna_buah);
echo $cari;
echo "<br>";
$cari = array_search(3,$warna_buah,true);
echo $cari;
echo "<br>";
echo "<br>";
$hewan = array(
    array("kucing", "darat"),
    array("ikan", "air"),
    array("burung", "udara")
);
$cari = array_search("kucing",$hewan[0]);
echo $cari;
/* Bisa digunakan disemua array jika diarray terindeks akan menampilkan indeksnya,
jika diarray asosiatif yang dicari harus valuenya dan akan menampilkan keynya,
dan jika diarray multidimensi dibagian variabel dicari harus diberikan indeks arraynya.
Lalu ada atribut yang opsional yaitu strict jika true digunakan untuk mencari data sesuai dengan tipe datanya
dan jika false adalah default.*/
echo "<hr>";

//array_filter()
$angka = array(1,2,3,4,5,6,7,8,9,10);
$ganjil = array_filter($angka,function($x){
    return $x % 2 == 1;
});
print_r($ganjil);
echo "<br>";
echo "<br>";
$warna_buah = array(
    "merah" => "apel",
    "kuning" => "pisang",
    "hijau" => "melon",
);

$filter = array_filter($warna_buah,function($y){
    return $y == "merah";
},ARRAY_FILTER_USE_KEY);
print_r($filter);
echo "<br>";
echo "<br>";
$hewan = array(
    array("kucing","kadal","badak","koala","singa"),
    array("ikan","air"),
    array("burung","udara")
);
$filter = array_filter($hewan[0],function($awal){
    if ($awal[0] == "k"){
        echo $awal." ";
    }
});
/* Bisa digunakan disemua array, diarray asosiatif dapat menggunakan ARRAY_FILTER_USE_KEY untuk
memfilter keynya dan ARRAY_FILTER_USE_BOTH untuk memfilter valuenya.*/
echo "<hr>";

//fungsi sorting
$angka = array(3,6,7,8,4,5,2,10,9,1);
rsort($angka);
print_r($angka);
echo "<br>";
echo "<br>";
sort($angka);
print_r($angka);

echo "<br>";
echo "<br>";

$warna_buah = array(
    2 => "apel",
    3 => "pisang",
    1 => "melon",
);
asort($warna_buah);
print_r($warna_buah);
echo "<br>";
echo "<br>";
ksort($warna_buah);
print_r($warna_buah)
?>