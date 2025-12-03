<?php
require_once __DIR__ . "/../../data_base/koneksi/koneksi.php";

if(isset($_POST["login"])){
    $user_name = $_POST["username"];
    $pw = $_POST["password"];
    $pw_MD5 = md5($pw);
    $ambil_data = "SELECT * FROM user WHERE username = ? AND password = ?";
    $stmt = $conn->prepare($ambil_data);
    $stmt->bind_param("ss", $user_name, $pw_MD5);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $_SESSION['username'] = $user['username'];
        $_SESSION['level'] = $user['level']; 
        $_SESSION['logged_in'] = true;

        header("Location: ../tampilan/menegement.php");
        exit();
    } else {
        $error = "Username atau password salah.";
    }
}
?>