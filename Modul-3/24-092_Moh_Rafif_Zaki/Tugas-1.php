<?php
$fruits = array("Avocado","Bluberry","Cherry","Mango","Strawberry","Banana","Apple","Watermelon");
echo "I like ".$fruits[0].", ".$fruits[1]." and ".$fruits[2].".";
echo "<br>";
$panjang = count($fruits);
$ind = 0;
while ($ind < $panjang){
    if ($ind == $panjang-1){
        echo 'Nilai terakhir dari array $fruits setelah menambahkan 5 data = '.$fruits[$ind]."<br>";
        echo 'indeks terakhir dari array $fruits setelah menambahkan 5 data = '.$ind;
    }
    $ind++;
}
echo "<hr>";
array_pop($fruits);   //Menghapus indeks terakhir dari array $fruits

$panjang = count($fruits);
$ind = 0;
while ($ind < $panjang){
    if ($ind == $panjang-1){
        echo 'Nilai terakhir dari array $fruits setelah menghapus 1 data = '.$fruits[$ind]."<br>";
        echo 'indeks terakhir dari array $fruits setelah menghapus 1 data = '.$ind;
    }
    $ind++;
}

echo "<hr>";

$veggies = array("Carrot","Broccoli","Tomato");
foreach($veggies as $sayur){
    echo $sayur."<br>";
}
?>