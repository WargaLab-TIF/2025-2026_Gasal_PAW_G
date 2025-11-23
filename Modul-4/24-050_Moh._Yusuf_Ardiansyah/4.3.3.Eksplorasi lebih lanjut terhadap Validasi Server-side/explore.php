<?php
require_once 'validate.inc';
$tests=[['surname'=>'Putra','email'=>'putra@example.com','age'=>'25','birthdate'=>'1999-12-31'],['surname'=>'Putra123','email'=>'bademail','age'=>'25.5','birthdate'=>'1999-02-30'],['surname'=>'','email'=>'','age'=>'','birthdate'=>'']];
echo "<pre>";
foreach($tests as $i=>$t){$errors=[];$ok=validateAll($t,$errors);echo "Test #".($i+1)." => ".($ok?"VALID":"INVALID").PHP_EOL;if(!$ok){foreach($errors as $k=>$v)echo "  - $k : $v".PHP_EOL;}else{echo "  All good.".PHP_EOL;}echo str_repeat('-',40).PHP_EOL;}
echo "</pre>";
?>
