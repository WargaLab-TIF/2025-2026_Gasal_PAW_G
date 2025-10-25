<?php
$errors = array();

function validateName($field_list, $field_name)
{
    global $errors;

    if (!isset($field_list[$field_name]) || trim($field_list[$field_name]) == '') {
        $errors[] = "Field $field_name harus diisi.";
        return false;
    }

    $pattern = "/^[a-zA-Z'-]+$/";
    if (!preg_match($pattern, $field_list[$field_name])) {
        $errors[] = "Field $field_name hanya boleh berisi huruf alfabet.";
        return false;
    }

    return true;
}

function validateEmail($field_list, $field_name)
{
    global $errors;

    if (!isset($field_list[$field_name]) || trim($field_list[$field_name]) == '') {
        $errors[] = "Field $field_name harus diisi.";
        return false;
    }

    if (!filter_var($field_list[$field_name], FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Field $field_name tidak valid.";
        return false;
    }

    return true;
}
?>
