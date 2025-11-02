<?php
require 'prosesData.php';

$error = [];
$nama = '';
$email = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $email = $_POST['email'];

    $error = validasi($nama, $email);
}

?>
<!DOCTYPE html>
<html>
<head><title>Validasi Sederhana</title></head>
<body>
    
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (!empty($error)) {
            echo "<p><b>$nama</b> - " . implode(", ", $error) . "</p>";
        } else {
            echo $nama.$email;
        }
    }

    include 'form.php';
    ?>
</body>
</html>
