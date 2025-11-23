<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">

    <label for="surname">Masukkan Nama</label>
    <input type="text" id="surname" name="surname" 
           value="<?= $surname ?? "" ?>">
    <span><?php echo $errors['surname'] ?? ''; ?></span>
    <br>

    <label for="email">Masukkan Email</label>
    <input type="text" id="email" name="email" 
           value="<?= $email ?? "" ?>">
    <span><?php echo $errors['email'] ?? ''; ?></span>
    <br>

    <label for="nomor">Masukkan Nomor Telepon</label>
    <input type="text" id="nomor" name="nomor" 
           value="<?= $nomor ?? "" ?>">
    <span><?php echo $errors['nomor'] ?? ''; ?></span>
    <br>

    <input type="submit" name="submit" value="Kirim">
</form>