<!-- 4.3.2 (Nomor 4) -->
<!-- Memindahkan form dari pemrosesan data -->
<form action="Tugas-4.3.2.php" method="post">
    <!-- Inputan 4.3.2 (Nomor 5) -->
    Masukkan nama: <input type="text" name="surname1">
    <br>
    <!-- Inputan 4.3.2 (Nomor 7) -->
    Masukkan nama: <input type="text" name="surname2" value="<?php echo $_POST['surname2'] ?? ""; ?>">
    <br>
    <input type="submit" value="Submit" name="submit1">
</form>