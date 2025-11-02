<?php
function validateName($name) {
    if (empty($name)) {
        return "Nama tidak boleh kosong!";
    } elseif (!preg_match("/^[a-zA-Z ]*$/", $name)) {
        return "Nama tidak boleh berisikan angka dan simbol!";
    }
    return ""; // artinya tidak ada error
}
?>
