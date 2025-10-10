<head>
    <title>Deret Angka</title>
    <style>
        .box-angka {
            border: 2px dotted black;
            padding: 10px 20px;
            display: inline-block;
            text-align: center;
            font-family: 'Courier New', Courier, monospace;
            font-size: 1.5em;
            line-height: 1.6;
        }
    </style>
</head>
<body>

<div class="box-angka">
    <?php

    for ($i = 0; $i <= 20; $i += 4) {
        echo $i . "<br>";
    }
    ?>
</div>

</body>
</html>