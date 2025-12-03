<?php
$host = 'localhost';
$username = 'root';
$password = '';
$db = 'store';

try {
    $conn = mysqli_connect($host, $username, $password, $db);
} catch (Exception $e) {
    echo $e;
}
