<?php
function validateName($f,$k){
    if(!isset($f[$k])) return false;
    $v=trim($f[$k]);
    if($v==='') return false;
    return preg_match("/^[a-zA-Z'\\-]+$/",$v);
}
?>
