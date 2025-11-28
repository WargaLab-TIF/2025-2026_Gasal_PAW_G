<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    $matkul = array("PTI","ALPRO","DPW","STRUKDAT","JARKOM","PAW","PSBF","RPL");
    $praktikum = array("JARKOM","PAW");

    for ($i = 0; $i <= 7; $i++) {
        if ($matkul[$i] == "JARKOM" || $matkul[ $i] == "PAW") {
            echo"Saya sedang mengambil matkul $matkul[$i] termasuk praktikun nya <br>" ; 

        }elseif ($i == 6 || $i == 7) {
        echo "Saya belum mengambil matkul $matkul[$i] <br>";
        
        }else {
            echo "Saya sudah mengambil matkul $matkul[$i] semester lalu <br>";
        }
}
    ?>
</body>
</html>