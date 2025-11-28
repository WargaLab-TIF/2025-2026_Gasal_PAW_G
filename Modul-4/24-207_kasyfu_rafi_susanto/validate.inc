<?php 
function validateName($field_list, &$errors ,$fied_name){ 
 if (!isset($field_list[$fied_name])){ 
  $errors[$fied_name] = "nama tidak boleh kosong"; 
  return false; 
 } 
 $pattern = "/^[a-zA-Z'-]+$/"; 
 if (!preg_match($pattern,$field_list[$fied_name])){ 
  $errors[$fied_name] = "format harus alfabet"; 
  return false; 
 } 
 return true; 
} 
?>
