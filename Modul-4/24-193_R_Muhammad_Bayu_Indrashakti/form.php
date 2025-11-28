<?php

$error = [];
$data = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data['firstname'] = trim($_POST['firstname'] ?? '');
    $data['surname']   = trim($_POST['surname'] ?? '');

    if ($data['firstname'] == '') $error['firstname'] = 'Firstname wajib diisi';
    if ($data['surname'] == '')   $error['surname']   = 'Surname wajib diisi';

    if (!$error) {
        echo "'Form submitted successfully with no errors'<br>";
        echo "Nama Depan: " . htmlspecialchars($data['firstname']) . "<br>";
        echo "Nama Belakang (Surname): " . htmlspecialchars($data['surname']) . "<br><br>";
        $data = [];
    } else {
        echo "(Error) Periksa kembali input kamu.<br><br>";
    }
}

include 'form.inc';
?>
