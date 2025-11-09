<?php
$dbHost = '127.0.0.1';
$dbUser = 'root';
$dbPass = '';
$dbName = 'suplier';
$mysqli = new mysqli($dbHost, $dbUser, $dbPass, $dbName);
if ($mysqli->connect_errno) {
    http_response_code(500);
    die('Gagal konek database: ' . $mysqli->connect_error);
}
$mysqli->set_charset('utf8mb4');

$id = (int)($_GET['id'] ?? 0);
if ($id > 0) {
    $stmt = $mysqli->prepare('DELETE FROM suppliers WHERE id = ?');
    $stmt->bind_param('i', $id);
    $stmt->execute();
}

header('Location: index.php');
exit;


