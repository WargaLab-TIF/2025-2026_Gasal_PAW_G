<?php
// Validation functions

// Validasi nama (alfabet)
function validateName($field_list, $field_name) {
    if (!isset($field_list[$field_name]) || empty($field_list[$field_name])) {
        return false;
    }
    $pattern = "/^[a-zA-Z'\s-]+$/"; // format nama (alfabet)
    if (!preg_match($pattern, $field_list[$field_name])) {
        return false;
    }
    return true;
}

// Validasi dengan error details
function validateNameWithErrors($field_list, $field_name, &$errors) {
    if (!isset($field_list[$field_name]) || empty($field_list[$field_name])) {
        $errors[$field_name] = "Field '{$field_name}' is required.";
        return false;
    }
    $pattern = "/^[a-zA-Z'\s-]+$/"; // format nama (alfabet)
    if (!preg_match($pattern, $field_list[$field_name])) {
        $errors[$field_name] = "Field '{$field_name}' must contain only alphabetic characters.";
        return false;
    }
    return true;
}

// Validasi email
function validateEmail($field_list, $field_name, &$errors) {
    if (!isset($field_list[$field_name]) || empty($field_list[$field_name])) {
        $errors[$field_name] = "Field '{$field_name}' is required.";
        return false;
    }
    if (!filter_var($field_list[$field_name], FILTER_VALIDATE_EMAIL)) {
        $errors[$field_name] = "Field '{$field_name}' must be a valid email address.";
        return false;
    }
    return true;
}

// Validasi nomor
function validateNumber($field_list, $field_name, &$errors) {
    if (!isset($field_list[$field_name]) || empty($field_list[$field_name])) {
        $errors[$field_name] = "Field '{$field_name}' is required.";
        return false;
    }
    if (!is_numeric($field_list[$field_name])) {
        $errors[$field_name] = "Field '{$field_name}' must be a valid number.";
        return false;
    }
    return true;
}

// Validasi required field
function validateRequired($field_list, $field_name, &$errors) {
    if (!isset($field_list[$field_name]) || empty(trim($field_list[$field_name]))) {
        $errors[$field_name] = "Field '{$field_name}' is required.";
        return false;
    }
    return true;
}

// Validasi semua field
function validateAllFields($field_list, &$errors) {
    $isValid = true;
    
    // Validasi surname
    if (!validateNameWithErrors($field_list, 'surname', $errors)) {
        $isValid = false;
    }
    
    // Validasi firstname (required)
    if (!validateNameWithErrors($field_list, 'firstname', $errors)) {
        $isValid = false;
    }
    
    // Validasi email (required)
    if (!validateEmail($field_list, 'email', $errors)) {
        $isValid = false;
    }
    
    // Validasi phone (required)
    if (!validateNumber($field_list, 'phone', $errors)) {
        $isValid = false;
    }
    
    // Validasi URL (opsional - dikelola oleh fungsi validateURL)
    if (!validateURL($field_list, 'url', $errors)) {
        $isValid = false;
    }
    
    return $isValid;
}

// Validasi URL menggunakan regex
function validateURL($field_list, $field_name, &$errors) {
    // Jika kosong dan tidak wajib, skip (fungsi ini juga bisa digunakan untuk required field)
    if (!isset($field_list[$field_name]) || empty($field_list[$field_name])) {
        return true; // Kosong dianggap valid jika opsional
    }
    
    // Regex untuk validasi URL
    $pattern = "/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/";
    
    if (!preg_match($pattern, $field_list[$field_name])) {
        $errors[$field_name] = "Field '{$field_name}' must be a valid URL format (e.g., http://example.com or example.com).";
        return false;
    }
    
    return true;
}

// Validasi URL menggunakan filter_var (alternatif yang lebih robust)
function validateURLWithFilter($field_list, $field_name, &$errors) {
    if (!isset($field_list[$field_name]) || empty($field_list[$field_name])) {
        $errors[$field_name] = "Field '{$field_name}' is required.";
        return false;
    }
    
    // Gunakan FILTER_VALIDATE_URL untuk validasi yang lebih ketat
    if (!filter_var($field_list[$field_name], FILTER_VALIDATE_URL)) {
        $errors[$field_name] = "Field '{$field_name}' must be a valid URL.";
        return false;
    }
    
    return true;
}
