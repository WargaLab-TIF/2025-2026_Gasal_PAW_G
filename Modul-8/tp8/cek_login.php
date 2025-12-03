<?php
session_start();
require_once "conn.php";

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: login.php");
    exit;
}

$username = trim($_POST['username'] ?? '');
$password = $_POST['password'] ?? '';

if ($username === '' || $password === '') {
    die("Username dan password harus diisi.");
}

// ambil user berdasarkan username
$sql = "SELECT id_user, username, password, nama, level FROM `user` WHERE username = ? LIMIT 1";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$res = $stmt->get_result();
$user = $res->fetch_assoc();

if (!$user) {
    $stmt->close();
    header("Location: login.php?error=1");
    exit;
}

// cek password
$dbpass = $user['password'];

$pass_ok = false;
if ($dbpass === $password) $pass_ok = true;
if (!$pass_ok && md5($password) === $dbpass) $pass_ok = true;

if (!$pass_ok) {
    header("Location: login.php?error=1");
    exit;
}

$_SESSION['id_user'] = $user['id_user'];
$_SESSION['username'] = $user['username'];
$_SESSION['nama'] = $user['nama'];
$_SESSION['level'] = (int)$user['level'];


// sesuai level
if ($_SESSION['level'] === 1) header("Location: owner.php");
else header("Location: kasir.php");

exit;
?>
