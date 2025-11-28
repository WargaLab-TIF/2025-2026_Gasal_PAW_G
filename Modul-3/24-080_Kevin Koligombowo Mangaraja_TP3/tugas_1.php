<H1>SCRIP AWAL</H1>
<?php
$fruits = array("Avocado", "Blueberry", "Cherry");
echo "i like " .$fruits[0] . "," .$fruits[1] . " and " . $fruits[2] . ".";
?>
<h1>3.1.1</h1>
<?php
$fruits = array("Avocado", "Blueberry", "Cherry");

// Menambah 5 data baru
array_push($fruits, "Grape", "Mango", "Orange", "Strawberry", "Watermelon");

// Menampilkan nilai dengan indeks tertinggi
$indeks_tertinggi = count($fruits) -1 ;
echo "Nilai dengan indeks tertinggi adalah: " . $fruits[$indeks_tertinggi] . "<br>";

// Menampilkan indeks tertinggi
echo "Indeks tertinggi dari array adalah: " . $indeks_tertinggi;
?>

<h1>3.1.2</h1>
<?php
$fruit = array("Avocado", "Blueberry", "Cherry", "Grape", "Mango", "Orange", "Strawberry", "Watermelon");

// Hapus 1 data tertentu, misalnya "Mango" yang berada di indeks 4
unset($fruit[4]);

// Menampilkan nilai dengan indeks tertinggi
$indeks_tertinggi = count($fruit);
echo "Nilai dengan indeks tertinggi adalah: " . $fruit[$indeks_tertinggi] . "<br>";

// Menampilkan indeks tertinggi
echo "Indeks tertinggi dari array adalah: " . $indeks_tertinggi;
?>

<h1>3.1.3</h1>

<?php
// Membuat array baru dengan 3 data
$veggies = array("Carrot", "Broccoli", "Spinach");

// Menampilkan seluruh data dari array $veggies
echo "Seluruh data dari array \$veggies adalah: ";
print_r($veggies);
?>
