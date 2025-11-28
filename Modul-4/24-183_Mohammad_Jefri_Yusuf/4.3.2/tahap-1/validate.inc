<?php 

function validateName(&$errors,$field_list, $field_name)
{
    if (empty($field_list[$field_name])) {
        $errors[$field_name] = "Surname is required";
        return false;
    }
    $pattern = "/^[a-zA-Z'-]+$/"; // format nama (alfabet)
    if (!preg_match($pattern, $field_list[$field_name])) {
        $errors[$field_name] = "Surnam format is invalid";
        return false;
    }
    return true;
}

?>
