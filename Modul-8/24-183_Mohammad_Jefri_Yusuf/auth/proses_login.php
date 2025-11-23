<?php 
session_start();
require_once '../config/conn.php';

if(isset($_POST["submit"])){
    $username = htmlspecialchars($_POST["username"]);
    $password_input = htmlspecialchars($_POST["password"]);
    $password = md5($password_input);

    $_SESSION["old_username"] = $username;
    $_SESSION["old_password"] = $password_input;

    if (empty($username) && empty($password_input)) {
        $_SESSION["error"] = "Username dan password tidak boleh kosong!";
        header("Location: login.php");
        exit;
    } elseif (empty($username)) {
        $_SESSION["error"] = "Username tidak boleh kosong!";
        header("Location: login.php");
        exit;
    } elseif (empty($password_input)) {
        $_SESSION["error"] = "Password tidak boleh kosong!";
        header("Location: login.php");
        exit;
    }

    $sql = "SELECT * FROM user WHERE username = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 's', $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if(mysqli_num_rows($result) === 1){
        $row = mysqli_fetch_assoc($result);
        if($password === $row["password"]){
            $_SESSION["login"] = true;
            $_SESSION["username"] = $username;
            $_SESSION["nama"] = $row["nama"];
            $_SESSION["level"] = $row["level"];
            $_SESSION["id_user"] = $row["id_user"];
            header("Location: ../index.php");
            exit;
        } else {
            $_SESSION["error"] = "Password salah!";
            header("Location: login.php");
            exit;
        }
    } else {
        $_SESSION["error"] = "Username tidak ditemukan!";
        header("Location: login.php");
        exit;
    }
}

header("Location: ../index.php");
exit;
?>