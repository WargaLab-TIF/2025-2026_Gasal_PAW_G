<!-- 4.3.2 (Nomor 1) -->
<!-- File ini telah dirubah menjadi PHP -->
<form action="Tugas-4.3.2.php" method="post">
    Masukkan nama: <input type="text" name="surname">
    <input type="submit" value="Submit" name="submit">
</form>

<?php 
    require "form.inc";

    // 4.3.2 (Nomor 5)
    // Menampilkan pesan error dan form kosong setelah disubmit
    $error = [];
    $error["surname1"] = "";
    if (isset($_POST["submit1"])) {
        if (empty($_POST["surname1"])) {
            $error["surname1"] = "Tidak boleh kosong";
        } else if (preg_match("/^[a-zA-Z]+$/", $_POST["surname1"])) {
            $error["surname1"] = "Form submitted succesfully with no errors";    
        // 4.3.2 (Nomor 9)
        // validasi tambahan
        } else if (preg_match("/[1-9]/", $_POST["surname1"])) {
            $error["surname1"] = "Tidak boleh ada angka";
        // validasi tambahan
        } else if (preg_match("/[^a-zA-Z]/", $_POST["surname1"])) {
            $error["surname1"] = "Tidak boleh ada karakter spesial";
        }
    }
    
    // 4.3.2 (Nomor 7)
    // Menampilkan pesan error dan form yang telah diisi setelah disubmit
    $error["surname2"] = "";
    if (isset($_POST["submit1"])) {
        if (empty($_POST["surname2"])) {
            $error["surname2"] = "Tidak boleh kosong";
        } else if (preg_match("/^[a-zA-Z]+$/", $_POST["surname2"])) {
            $error["surname2"] = "Form submitted succesfully with no errors";    
        // 4.3.2 (Nomor 9)
        // validasi tambahan
        } else if (preg_match("/[1-9]/", $_POST["surname2"])) {
            $error["surname2"] = "Tidak boleh ada angka";
        // validasi tambahan
        } else if (preg_match("/[^a-zA-Z]/", $_POST["surname2"])) {
            $error["surname2"] = "Tidak boleh ada karakter spesial";
        }
    }
?>
<!-- Pesan error inputan 4.3.2 (Nomor 5) -->
<span><?php echo $error["surname1"]; ?></span>
<hr>
<!-- Pesan error inputan 4.3.2 (Nomor 7) -->
<span><?php echo $error["surname2"]; ?></span>