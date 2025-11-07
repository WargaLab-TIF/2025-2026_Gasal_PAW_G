<?php
function hasOnlyLettersAndHyphenApostrophe($v){return preg_match("/^[\p{L}\s'-]+$/u",trim($v))===1;}
function isLengthBetween($v,$min,$max){$n=mb_strlen(trim($v));return($n>=$min&&$n<=$max);}
function normalizeTrimLower($v){return strtolower(trim($v));}
function isValidEmail($v){return filter_var(trim($v),FILTER_VALIDATE_EMAIL)!==false;}
function isValidURL($v){return filter_var(trim($v),FILTER_VALIDATE_URL)!==false;}
function isValidFloat($v){return filter_var($v,FILTER_VALIDATE_FLOAT)!==false;}
function isValidIP($v){return filter_var(trim($v),FILTER_VALIDATE_IP)!==false;}
function isIntegerString($v){return ctype_digit(trim($v));}
function isNumericValue($v){return is_numeric($v);}
function isValidDateYMD($y,$m,$d){return checkdate((int)$m,(int)$d,(int)$y);}
function isValidDateString($s){$s=trim($s);if($s==='')return false;$p=explode('-',$s);if(count($p)!==3)return false;[$y,$m,$d]=$p;if(!ctype_digit($y)||!ctype_digit($m)||!ctype_digit($d))return false;return checkdate((int)$m,(int)$d,(int)$y);}
function validateSurname($values,$field,&$errors){$v=$values[$field]??'';if(trim($v)===''){$errors[$field]="Field '$field' wajib diisi.";return false;}if(!hasOnlyLettersAndHyphenApostrophe($v)){$errors[$field]="Format nama tidak valid.";return false;}if(!isLengthBetween($v,2,50)){$errors[$field]="Panjang nama harus 2 - 50 karakter.";return false;}return true;}
function validateEmailField($values,$field,&$errors){$v=$values[$field]??'';if(trim($v)===''){$errors[$field]="Field '$field' wajib diisi.";return false;}if(!isValidEmail($v)){$errors[$field]="Format email tidak valid.";return false;}return true;}
function validateAgeField($values,$field,&$errors){$v=$values[$field]??'';if(trim($v)===''){$errors[$field]="Field '$field' wajib diisi.";return false;}if(!isIntegerString($v)){$errors[$field]="Umur harus berupa angka bulat.";return false;}$i=(int)$v;if($i<0||$i>120){$errors[$field]="Umur harus antara 0 - 120.";return false;}return true;}
function validateBirthdateField($values,$field,&$errors){$v=$values[$field]??'';if(trim($v)===''){$errors[$field]="Field '$field' wajib diisi.";return false;}if(!isValidDateString($v)){$errors[$field]="Format tanggal tidak valid.";return false;}return true;}
function validateAll($values,&$errors){$errors=[];validateSurname($values,'surname',$errors);validateEmailField($values,'email',$errors);validateAgeField($values,'age',$errors);validateBirthdateField($values,'birthdate',$errors);return empty($errors);}
?>