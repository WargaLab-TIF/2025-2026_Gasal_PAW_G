<?php

function isi($data, $nama) {
    return isset($data[$nama]) ? htmlspecialchars($data[$nama]) : '';
}
?>

<p>Silakan isi nama Anda:</p>

<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
    <label>Nama Depan:</label><br>
    <input type="text" name="firstname" value="<?php echo isi($data, 'firstname'); ?>"><br>
    <?php if(isset($error['firstname'])) echo $error['firstname']."<br>"; ?>
    <br>

    <label>Nama Belakang (Surname):</label><br>
    <input type="text" name="surname" value="<?php echo isi($data, 'surname'); ?>"><br>
    <?php if(isset($error['surname'])) echo $error['surname']."<br>"; ?>
    <br>

    <input type="submit" value="Kirim">
</form>
