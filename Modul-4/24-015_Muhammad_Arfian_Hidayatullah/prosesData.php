<?php
require 'validate.inc';

// Cek apakah form dikirim dengan metode POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo "Silakan isi form terlebih dahulu.";
    exit;
}

// Buat array kosong untuk menampung pesan error
$errors = [];

// Panggil fungsi validasi
if (validateName($_POST, 'surname', $errors)) {
    echo 'Data OK!';
} else {
    echo 'Data invalid!<br>';
    foreach ($errors as $err) {
        echo htmlspecialchars($err) . "<br>";
    }
}
?>
