<form method="post" action="index.php">
    Nama: <input type="text" name="nama" value="<?php echo $nama ?? ''; ?>">
    <span ><?php echo $error['nama'] ?? ''; ?></span>
    <br><br>

    Email: <input type="text" name="email" value="<?php echo $email ?? ''; ?>">
    <span><?php echo $error['email'] ?? ''; ?></span>
    <br><br>

    <input type="submit" name="submit" value="Kirim">
</form>
