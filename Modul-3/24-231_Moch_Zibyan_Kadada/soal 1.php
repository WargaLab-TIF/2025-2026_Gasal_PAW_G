<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<pre>

    <?php
        $fruits = array("Avocado", "Blueberry", "Cherry");
        echo "I like " . $fruits[0] . ", " . $fruits[1] . " and " . $fruits[2] . ". <br>";
        
        echo "<hr>";

        //3.1.1
        array_push($fruits, "Orange", "Kiwi", "Banana", "Melon", "Lemon");
        var_dump($fruits); 
        echo "<br>";
        $index_tertinggi = array_key_last($fruits);
        echo "Dengan Nilai: " . $fruits[$index_tertinggi] . "<br>";
        echo "Berapa indeks tertinggi dari array fruits: " . $index_tertinggi . "<br>";
        
        echo "<hr>";
        //3.1.2
        array_splice($fruits, 1, 1);
        echo "<br>";
        var_dump($fruits);
        $index = array_key_last($fruits);
        echo "Dengan Nilai: " . $fruits[$index] . "<br>";
        echo "Berapa indeks tertinngi setelah di hapus 1 datanya: " . $index . "<br>";
        
        echo "<hr>";
        //3.1.3
        echo "<br>";
        $vaggies = array("Tomat", "Wortel", "Kangkung");
        print_r($vaggies);

        echo "<hr>";
    ?>

</pre>
</body>
</html>
