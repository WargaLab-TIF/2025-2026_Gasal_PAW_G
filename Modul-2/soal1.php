<head>>
    <title>Status Mata Kuliah</title>
    <style>
        .status-matkul {
            border: 2px dotted black;
            padding: 15px;
            display: inline-block;
            font-family: monospace; 
            line-height: 1.6;
        }
    </style>
</head>
<body>

    <div class="status-matkul">
        <?php
        $sudah_diambil = ['PTI', 'ALPRO', 'DPW', 'STRUKDAT'];
        foreach ($sudah_diambil as $matkul) {
            echo "Saya sudah mengambil matkul $matkul semester lalu<br>";
        }

        $sedang_diambil = ['JARKOM', 'PAW'];
        foreach ($sedang_diambil as $matkul) {
            echo "Saya sedang mengambil matkul $matkul termasuk praktikum nya<br>";
        }

        $belum_diambil = ['PSBF', 'RPL'];
        foreach ($belum_diambil as $matkul) {
            echo "Saya belum mengambil matkul $matkul<br>";
        }
        ?>
    </div>

</body>
</html>