<?php
    function validateName($field_list, $field_name, &$errors = []){
        if (!is_array($errors)) {
            $errors = [];
        }
        $value = $field_list[$field_name];
        $pattern = "/^[a-zA-Z']+$/";
        if (empty(trim($value))) {
            $errors[$field_name] =$field_name .' wajib di isi.';
            return false;
        }
        if(!preg_match($pattern, $value)){
            $errors[$field_name] = $field_name.' berupa huruf alpabet.';
            return false;
        }
        return true;
    }
?>
