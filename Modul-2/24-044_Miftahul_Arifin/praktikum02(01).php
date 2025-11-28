<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>if elseif else for</title>
</head>
<body>
    <?php 
    $matkul = ["PTI","ALPRO","DPW","STRUKDAT","JARKOM","PAW","PSBF","RPL"];

    $praktikum = ["JARKOM","PAW"];

    for ($a = 0 ; $a < count($matkul); $a++) {
            $tampung = $matkul[$a];
         if (in_array($tampung , $praktikum)) {
            echo "saya sedang mengambil matkul  $tampung termasuk praktikum nya <br>";
         } elseif ($tampung == $matkul [6]) {
            echo "saya belum mengambil matkul $tampung <br>";
         } elseif ($tampung == $matkul[7]){
            echo "saya belum mengambil matkul $tampung <br>";
         }else {
            echo "saya sudah mengambil matkul $tampung semester lalu <br>";
         }
    }
    ?>
</body>
</html>