<head>
    <title>Daftar Mata Kuliah</title>
    <style>
        .box-matkul {
            border: 2px dotted black;
            padding: 15px;
            display: inline-block;
            font-family: monospace; 
            line-height: 
        }
    </style>
</head>
<body>

<div class="box-matkul">
    <?php
   
    $suka_matkul = ['PTI', 'ALPRO', 'DPW', 'STRUKDAT', 'JARKOM', 'PAW'];
    
   l
    $tidak_diambil = ['PSBF', 'RPL'];

    
    foreach ($suka_matkul as $matkul) {
        echo "Saya suka $matkul<br>";
    }

    foreach ($tidak_diambil as $matkul) {
        echo "Saya tidak mengambil matkul $matkul<br>";
    }
    ?>
</div>

</body>
</html>