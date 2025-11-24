<?php
require_once "db.php";
require_once "auth.php"; 

$sql_user = "SELECT id_user, level FROM user WHERE username = ?";
$stmt_user = $conn->prepare($sql_user);
$stmt_user->bind_param("s", $_SESSION['username']);
$stmt_user->execute();
$result_user = $stmt_user->get_result();
$args = $result_user->fetch_all(MYSQLI_ASSOC);
$stmt_user->close();

if (empty($args) || $args[0]['level'] != '1') {
    header("location: index.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action'])) {
    $action = $_POST['action'];

    if ($action == 'create') {
        $username = $_POST['username'];
        $password = md5($_POST['password']); 
        $nama = $_POST['nama'];
        $alamat = $_POST['alamat'];
        $hp = $_POST['hp'];
        $level = $_POST['level'];

        $stmt = $conn->prepare("INSERT INTO user (username, password, nama, alamat, hp, level) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssi", $username, $password, $nama, $alamat, $hp, $level);

        if ($stmt->execute()) {
            header("location: master_user.php?status=sukses_tambah");
        } else {
            $error_message = $stmt->errno == 1062 ? "Username sudah digunakan." : $stmt->error;
            header("location: master_user.php?status=gagal_tambah&error=" . urlencode($error_message));
        }
        $stmt->close();
        
    } elseif ($action == 'update') {
        $id = $_POST['id'];
        $password = $_POST['password'];
        $nama = $_POST['nama'];
        $alamat = $_POST['alamat'];
        $hp = $_POST['hp'];
        $level = $_POST['level'];

        if (!empty($password)) {
            $hashed_password = md5($password);
            $stmt = $conn->prepare("UPDATE user SET password=?, nama=?, alamat=?, hp=?, level=? WHERE id_user=?");
            $stmt->bind_param("ssssii", $hashed_password, $nama, $alamat, $hp, $level, $id);
        } else {
            $stmt = $conn->prepare("UPDATE user SET nama=?, alamat=?, hp=?, level=? WHERE id_user=?");
            $stmt->bind_param("sssii", $nama, $alamat, $hp, $level, $id);
        }
        
        if ($stmt->execute()) {
            header("location: master_user.php?status=sukses_ubah");
        } else {
            header("location: master_user.php?status=gagal_ubah&error=" . urlencode($stmt->error));
        }
        $stmt->close();

    } elseif ($action == 'delete') {
        $id = $_POST['id'];

        $stmt_check = $conn->prepare("SELECT COUNT(*) FROM transaksi WHERE user_id = ?");
        $stmt_check->bind_param("i", $id);
        $stmt_check->execute();
        $stmt_check->bind_result($count);
        $stmt_check->fetch();
        $stmt_check->close();

        if ($count > 0) {
            header("location: master_user.php?status=gagal_hapus&error=" . urlencode("User masih terhubung dengan $count transaksi."));
            exit;
        }

        $stmt = $conn->prepare("DELETE FROM user WHERE id_user = ?");
        $stmt->bind_param("i", $id);
        
        if ($stmt->execute()) {
            header("location: master_user.php?status=sukses_hapus");
        } else {
            header("location: master_user.php?status=gagal_hapus&error=" . urlencode($stmt->error));
        }
        $stmt->close();
    }
}

header("location: master_user.php");
exit;
?>