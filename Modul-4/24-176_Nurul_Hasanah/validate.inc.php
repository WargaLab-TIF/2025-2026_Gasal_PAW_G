<?php

function validateName($field_list, $field_name, &$errors = []) {
    if (!isset($field_list[$field_name]) || trim($field_list[$field_name]) == "") {
        $errors[$field_name] = "Field $field_name tidak boleh kosong!";
        return false;
    }

    $pattern = "/^[a-zA-Z'-]+$/";
    if (!preg_match($pattern, $field_list[$field_name])) {
        $errors[$field_name] = "Field $field_name hanya boleh berisi huruf alfabet!";
        return false;
    }

    return true;
}

function validateEmail($field_list, $field_name, &$errors) {
    if (!isset($field_list[$field_name]) || trim($field_list[$field_name]) == "") {
        $errors[$field_name] = "Field $field_name tidak boleh kosong!";
        return false;
    }

    if (!filter_var($field_list[$field_name], FILTER_VALIDATE_EMAIL)) {
        $errors[$field_name] = "Format $field_name tidak valid!";
        return false;
    }

    return true;
}

function validateAge($field_list, $field_name, &$errors) {
    if (!isset($field_list[$field_name]) || trim($field_list[$field_name]) == "") {
        $errors[$field_name] = "Field $field_name tidak boleh kosong!";
        return false;
    }

    $age = (int)$field_list[$field_name];
    if ($age < 1 || $age > 120) {
        $errors[$field_name] = "Umur harus di antara 1 dan 120!";
        return false;
    }

    return true;
}

function validatePhone($field_list, $field_name, &$errors) {
    if (!isset($field_list[$field_name]) || trim($field_list[$field_name]) == "") {
        $errors[$field_name] = "Field $field_name tidak boleh kosong!";
        return false;
    }

    $pattern = "/^[0-9]{10,13}$/";
    if (!preg_match($pattern, $field_list[$field_name])) {
        $errors[$field_name] = "Nomor telepon harus berupa angka (10–13 digit)!";
        return false;
    }

    return true;
}

function validatePassword($field_list, $field_name, &$errors) {
    if (!isset($field_list[$field_name]) || trim($field_list[$field_name]) == "") {
        $errors[$field_name] = "Field $field_name tidak boleh kosong!";
        return false;
    }

    $password = $field_list[$field_name];

    
    if (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/", $password)) {
        $errors[$field_name] = "Password harus minimal 8 karakter, mengandung huruf besar, kecil, angka, dan simbol!";
        return false;
    }

    return true;
}
?>
