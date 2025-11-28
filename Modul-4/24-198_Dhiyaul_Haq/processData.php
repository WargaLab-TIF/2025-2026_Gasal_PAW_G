<?php
    // 4.3.1 (Nomor 2)
    // Ubah file processData.php agar menambahkan validate.inc
    require 'validate.inc';
    if (validateName($_POST, 'surname'))
        echo 'Data OK!';
    else
        echo 'Data invalid!';

    echo "<hr>";

    // 4.3.1 (Nomor 5)
    // Menampilkan pesan error
    $error = [];
    $error["surname"] = "";
    if (validateNameArray($error, $_POST, 'surname'))
        echo 'Data OK!';
    else
        echo $error["surname"];
?>