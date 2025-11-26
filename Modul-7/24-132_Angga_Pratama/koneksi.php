<?php
$mysqli= new mysqli("localhost","root","","tp_modul7");

if ($mysqli -> connect_errno){
    die('Failed to connect to MySQL:' . $mysqli -> connect_error);
}
?>