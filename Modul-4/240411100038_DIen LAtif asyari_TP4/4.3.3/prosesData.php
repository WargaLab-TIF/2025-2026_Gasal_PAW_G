<?php
function validasi($nama, $email) {
    $error = [];

    if (!preg_match("/^[a-zA-Z ]+$/", $nama)) {
        $error['nama'] = "Nama tidak boleh berisi angka atau simbol";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error['email'] = "Format email tidak valid";
    }

    return $error;
}
?>
