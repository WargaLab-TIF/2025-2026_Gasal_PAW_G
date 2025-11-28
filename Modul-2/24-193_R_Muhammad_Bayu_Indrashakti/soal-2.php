<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    $matkul = array("PTI","ALPRO","DPW","STRUKDAT","JARKOM","PAW","PSBF","RPL") ;
        foreach ($matkul as $mk) {
            switch ($mk) {
                case "PTI":
                    echo"Saya suka PTI <br>";
                    break;
                case "ALPRO":
                    echo "Saya suka ALPRO <br>";
                    break;
                case "DPW":
                    echo "Saya suka DPW <br>";
                    break;
                case "STRUKDAT":
                    echo "Saya suka Strukdat <br>";
                    break;
                case "JARKOM":
                    echo "Saya suka JARKOM <br>";
                    break;
                case "PAW":
                    echo "Saya suka PAW <br>";
                    break;
                default:
                    echo "Saya tidak mengambil matkul $mk <br>";
            }
        }
    ?>
</body>
</html>