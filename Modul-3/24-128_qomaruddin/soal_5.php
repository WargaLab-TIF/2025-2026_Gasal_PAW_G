<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        $students = array(
            array("alex","220401","0812345678"),
            array("bianca","220402","0812345687"),
            array("candice","220403","0812345665"),
        );
        $students[] = array("alex","220401","0812345678");
        $students[] = array("alex","220401","0812345678");
        $students[] = array("alex","220401","0812345678");
        $students[] = array("alex","220401","0812345678");
        $students[] = array("alex","220401","0812345678");
        $row = count($students);
    ?>
    <table border="1px solid">
        <tr>
            <td><b>Name</b></td>
            <td><b>NIM</b></td>
            <td><b>Mobile</b></td>
        </tr>
        <?php for($i = 0; $i < $row; $i++):?>
            <tr>
                <?php foreach($students[$i] as $nilai):?>
                    <td><?php echo ("$nilai") ?></td>
                <?php endforeach ?>
            </tr>
        <?php endfor?>
    </table>
</body>
</html>
