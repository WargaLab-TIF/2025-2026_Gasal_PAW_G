<?php
$fruits = ["Anggur", "Cherry", "Nanas", "Mangga", "Durian"];

// 3.1.1 Tambahkan 5 data baru
array_push($fruits, "Apel", "Jambu", "Pisang", "Delima", "Jeruk");
echo "Isi array fruits: <br>";
print_r($fruits);
echo "<br>Indeks tertinggi saat ini: ". (count($fruits) - 1) . "<br><br>";

//3.1.2 Menghapus 1 data
unset($fruits[3]);
echo "Setelah menghapus 1 data: <br>";
print_r($fruits);
echo "<br>Indeks tertinggi tetap: " . (count($fruits) - 1) . "<br><br>";

//3.1.3 Membuat array baru veggies yg memiliki 3 buah data
$veggies = ["Kangkung", "Terong", "Cabe"];
echo "Isi array vaggies : <br>";
print_r($veggies);

?>