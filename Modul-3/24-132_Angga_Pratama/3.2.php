<?php
echo "## Jawaban 3.2.1\n\n";
$fruits = ["Avocado", "Blueberry", "Cherry"];
$newData = ["Dragonfruit", "Elderberry", "Fig", "Grape", "Honeydew"];
for ($i = 0; $i < count($newData); $i++) {
    $fruits[] = $newData[$i];
}
$arrlength = count($fruits);
echo "Panjang (jumlah data) array \$fruits saat ini adalah: " . $arrlength . "\n\n";
echo "Seluruh data dalam array \$fruits:\n";
for ($x = 0; $x < $arrlength; $x++) {
    echo $fruits[$x] . "<br>";
}

echo "\n**Penjelasan Pertanyaan:**\n";
echo "**Apakah Anda perlu melakukan perubahan pada skrip perulangan FOR?**\n";
echo "Ya, perlu ada perubahan. Variabel `$arrlength` harus diperbarui dengan `count(\$fruits)` *setelah* data baru ditambahkan. Jika tidak, loop akan berhenti sebelum mencetak elemen-elemen baru.\n\n";
echo "**Mengapa demikian?**\n";
echo "Karena struktur perulangan `for` menggunakan kondisi `$x < $arrlength`. Jika `$arrlength` dihitung sebelum 5 data baru ditambahkan, nilainya adalah 3. Akibatnya, loop hanya akan berjalan untuk indeks 0, 1, dan 2, dan 5 data baru tidak akan ditampilkan. Dengan menghitung ulang panjangnya setelah penambahan, loop akan berjalan sebanyak jumlah elemen yang sebenarnya.\n\n";
echo "<hr>";
echo "## Jawaban 3.2.2\n\n";

$veggies = ["Carrot", "Broccoli", "Spinach"];
$veggiesLength = count($veggies);

echo "Seluruh data dalam array \$veggies:\n";
for ($i = 0; $i < $veggiesLength; $i++) {
    echo $veggies[$i] . "<br>";
}

echo "\n**Penjelasan Pertanyaan:**\n";
echo "**Apakah Anda membuat skrip baru atau memodifikasi?**\n";
echo "Cukup memodifikasi skrip yang sudah ada.\n\n";
echo "**Mengapa demikian?**\n";
echo "Karena logika untuk menampilkan array terindeks menggunakan 'for' loop adalah sama. Kita hanya perlu mengubah nama variabel array yang digunakan (dari '\$fruits' menjadi '\$veggies') dan memastikan variabel panjangnya dihitung dari array yang benar.";
?>