<form action="index.php" method="POST">
    <label>Masukkan Nama:</label><br>
    <input type="text" name="surname" value="<?php echo $surname; ?>"><br>

    <?php
    if (!empty($error)) {
        echo $surname . $error;
    }
    ?>

    <br>
    <input type="submit" name="submit" value="Kirim">
</form>
