<?php 
include 'koneksi.php'; 
if (!isset($_SESSION['level']) || $_SESSION['level'] != 1) {
    header("Location: crud_user.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah User Baru</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h2>Tambah User Baru</h2>
        <form action="proses_tambah.php" method="POST">
            <div class="form-group">
                <label>Username</label>
                <input type="text" class="form-control" name="username" placeholder="Username" required>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" class="form-control" name="password" placeholder="****" required>
            </div>
            <div class="form-group">
                <label>Nama User</label>
                <input type="text" class="form-control" name="nama" placeholder="Nama User" required>
            </div>
            <div class="form-group">
                <label>Alamat</label>
                <textarea class="form-control" name="alamat" rows="3"></textarea>
            </div>
            <div class="form-group">
                <label>Nomor HP</label>
                <input type="text" class="form-control" name="hp" placeholder="Nomor HP">
            </div>
            <div class="form-group">
                <label>Jenis User</label>
                <select class="form-control" name="level" required>
                    <option value="">--- Pilih Jenis User ---</option>
                    <option value="1">Admin</option>
                    <option value="2">User Biasa</option>
                </select>
            </div>
            <button type="submit" class="btn btn-success">Simpan</button>
            <a href="crud_user.php" class="btn btn-danger">Batal</a>
        </form>
    </div>
</body>
</html>