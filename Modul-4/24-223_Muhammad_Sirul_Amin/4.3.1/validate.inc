<?php
$errors = [];

function validateName($field_list, $field_name) {
    global $errors;
    if (!isset($field_list[$field_name]) || trim($field_list[$field_name]) === '') {
        $errors[$field_name] = "Field $field_name tidak boleh kosong.";
        return false;
    }
    $pattern = "/^[a-zA-Z'-]+$/";
    if (!preg_match($pattern, $field_list[$field_name])) {
        $errors[$field_name] = "Field $field_name hanya boleh berisi huruf.";
        return false;
    }
    return true;
}

function validateEmail($field_list, $field_name) {
    global $errors;
    if (!filter_var($field_list[$field_name], FILTER_VALIDATE_EMAIL)) {
        $errors[$field_name] = "Format email tidak valid.";
        return false;
    }
    return true;
}

function validateAge($field_list, $field_name) {
    global $errors;
    if (!is_numeric($field_list[$field_name]) || $field_list[$field_name] <= 0) {
        $errors[$field_name] = "Umur harus berupa angka positif.";
        return false;
    }
    return true;
}
?>