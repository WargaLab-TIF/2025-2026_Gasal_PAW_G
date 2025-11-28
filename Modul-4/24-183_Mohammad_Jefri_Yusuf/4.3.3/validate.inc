<?php 
function validateName(&$errors,$field_list, $field_name)
{
    if (empty($field_list[$field_name])) {
        $errors[$field_name] = "Surname is required";
        return false;
    }
    $pattern = "/^[a-zA-Z'-]+$/"; // format nama (alfabet)
    if (!preg_match($pattern, $field_list[$field_name])) {
        $errors[$field_name] = "Surname format is invalid";
        return false;
    }
    return true;
}

function validateEmail(&$errors,$field_list, $field_name)
{
    if (empty($field_list[$field_name])) {
        $errors[$field_name] = "Email is required";
        return false;
    }
    if (!filter_var($field_list[$field_name], FILTER_VALIDATE_EMAIL)) {
        $errors[$field_name] = "Email format is invalid";
        return false;
    }
    return true;
}

function validateAge(&$errors, $field_list, $field_name)
{
    if (empty($field_list[$field_name])) {
        $errors[$field_name] = "Age is required";
        return false;
    }
    if (!is_numeric($field_list[$field_name])) { // is_numeric 
        $errors[$field_name] = "Age harus berupa angka";
        return false;
    }
    return true;
}

function validateWebsite(&$errors, $field_list, $field_name)
{
    if (empty($field_list[$field_name])) {
        $errors[$field_name] = "Website is required";
        return false;
    }
    if (!filter_var($field_list[$field_name], FILTER_VALIDATE_URL)) { // FILTER_VALIDATE_URL 
        $errors[$field_name] = "Website format is invalid";
        return false;
    }
    return true;
}
?>
