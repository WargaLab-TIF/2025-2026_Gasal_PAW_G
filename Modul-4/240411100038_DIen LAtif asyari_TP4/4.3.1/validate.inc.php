<?php
function validateName($field_list,$field_name){
    if (!isset($field_list[$field_name])) {
        $field_list['surname']='nama wajib di isi';
    return false;}
    $pattern = "/^[a-zA-Z'-]+$/";
    if (!preg_match($pattern,$field_list[$field_name])){
        $field_list['surname'] = 'nama tidak boleh menggunakan simbol';
    return false;
}
    return True;
}

