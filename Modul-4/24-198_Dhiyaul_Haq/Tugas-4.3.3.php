<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eksplorasi</title>
</head>
<body>
    <form action="" method="get">
        <input type="text" name="email" value="test@gmail.com">
        <input type="submit" value="submit">
    </form>
</body>
</html>
<?php
    // preg_match() 
    echo "<br>fungsi preg_match: ".preg_match("/box/", "box box box")."<hr>";

    // preg_match_all() 
    echo "fungsi preg_match_all: ".preg_match_all("/box/", "box box box")."<hr>";

    // trim() 
    echo trim(" menggunakan fungsi trim ")."<hr>";

    // strtolower()
    echo strtolower("HELLO WORLD")."<hr>";
    
    // strtoupper()
    echo strtoupper("hello world!")."<hr>";

    // filter_var()
    if (filter_var(10, FILTER_VALIDATE_INT)) {
        echo "TRUE"."<hr>";
    } else {
        echo "FALSE"."<hr>";
    }

    // filter_input()
    if (filter_input(INPUT_GET, "email", FILTER_VALIDATE_EMAIL)) {
        echo "Email benar <hr>";
    } else {
        echo "Email salah <hr>";
    }
    
    // FILTER_VALIDATE_EMAIL
    if (filter_var("t@g.c", FILTER_VALIDATE_EMAIL)) {
        echo "Email benar<hr>";
    } else {
        echo "Email salah <hr>";
    }

    // FILTER_VALIDATE_URL
    if (filter_var("http://www.google.com", FILTER_VALIDATE_URL)) {
        echo "URL benar<hr>";
    } else {
        echo "URL salah<hr>";
    }

    // FILTER_VALIDATE_FLOAT
    if (filter_var(12.5, FILTER_VALIDATE_FLOAT)) {
        echo "Bertipe float<hr>";
    } else {
        echo "Tidak bertipe float<hr>";
    }

    // FILTER_VALIDATE_IP
    if (filter_var("192.168.1.1", FILTER_VALIDATE_IP)) {
        echo "IP valid<hr>";
    } else {
        echo "IP tidak valid<hr>";
    }

    // is_float()
    echo "11.5 adalah float? ";
    echo var_dump(is_float(11.5))."<hr>";

    // is_int()
    echo "50 adalah int? ";
    echo var_dump(is_int(50))."<hr>";

    // is_numeric()
    echo "100 adalah angka? ";
    echo var_dump(is_numeric("100"))."<hr>";

    // is_string()
    echo "25 adalah string? ";
    echo var_dump(is_string("25"))."<hr>";

    // checkdate
    $bulan = date("m");
    $tanggal = date("d");
    $tahun = date("Y");
    echo "Hari ini bulan: $bulan, tanggal: $tanggal, tahun: $tahun ? ";
    echo var_dump(checkdate($bulan, $tanggal, $tahun));
?>