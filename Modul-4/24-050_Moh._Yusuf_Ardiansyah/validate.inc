<?php
function validateName($field_list, $field_name, array &$errors = []) {
    if (!isset($field_list[$field_name]) || trim($field_list[$field_name]) === '') {
        $errors[$field_name] = "Field '$field_name' wajib diisi.";
        return false;
    }
    $value = trim($field_list[$field_name]);
    if (mb_strlen($value) < 2) {
        $errors[$field_name] = "Nama terlalu pendek (min 2 karakter).";
        return false;
    }
    $pattern = "/^[a-zA-Z\s'-]+$/u";
    if (!preg_match($pattern, $value)) {
        $errors[$field_name] = "Format nama tidak valid: hanya huruf, spasi, ' atau -.";
        return false;
    }
    return true;
}

function validateEmail($field_list, $field_name, array &$errors = []) {
    if (!isset($field_list[$field_name]) || trim($field_list[$field_name]) === '') {
        $errors[$field_name] = "Field '$field_name' wajib diisi.";
        return false;
    }
    $value = trim($field_list[$field_name]);
    if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
        $errors[$field_name] = "Format email tidak valid.";
        return false;
    }
    return true;
}

function validateAge($field_list, $field_name, array &$errors = []) {
    if (!isset($field_list[$field_name]) || trim($field_list[$field_name]) === '') {
        $errors[$field_name] = "Field '$field_name' wajib diisi.";
        return false;
    }
    $value = trim($field_list[$field_name]);
    if (!ctype_digit($value)) {
        $errors[$field_name] = "Umur harus berupa angka bulat positif.";
        return false;
    }
    $int = (int)$value;
    if ($int < 0 || $int > 120) {
        $errors[$field_name] = "Umur harus antara 0 - 120.";
        return false;
    }
    return true;
}
?>
