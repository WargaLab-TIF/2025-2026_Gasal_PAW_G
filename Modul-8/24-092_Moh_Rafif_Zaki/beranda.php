<?php
include "header.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .judul{
            display: flex;
            justify-content: center;
            text-align: center;
            background: linear-gradient(to right,lightslategray,lightskyblue,lightslategray);
            padding: 150px;
            height: 279px;
        }
        h1{
            margin-top: 121px;
            
        }
    </style>
</head>
<body>
    <div class="judul">
        <h1>WELCOME <?php echo strtoupper($_SESSION['nama'])?></h1>
    </div>
</body>
</html>