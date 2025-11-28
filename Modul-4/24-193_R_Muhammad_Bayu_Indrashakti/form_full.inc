<?php
function isi($d,$k){return isset($d[$k])?htmlspecialchars($d[$k]):'';}
?>
<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
    <label>Nama Depan:</label><br>
    <input type="text" name="firstname" value="<?php echo isi($data,'firstname'); ?>"><br>
    <?php if(isset($error['firstname'])) echo $error['firstname']."<br>"; ?>
    <br>

    <label>Nama Belakang (Surname):</label><br>
    <input type="text" name="surname" value="<?php echo isi($data,'surname'); ?>"><br>
    <?php if(isset($error['surname'])) echo $error['surname']."<br>"; ?>
    <br>

    <label>Email:</label><br>
    <input type="text" name="email" value="<?php echo isi($data,'email'); ?>"><br>
    <?php if(isset($error['email'])) echo $error['email']."<br>"; ?>
    <br>

    <label>Umur:</label><br>
    <input type="text" name="age" value="<?php echo isi($data,'age'); ?>"><br>
    <?php if(isset($error['age'])) echo $error['age']."<br>"; ?>
    <br>

    <label>Tanggal Lahir:</label><br>
    <input type="text" name="day" size="2" placeholder="DD" value="<?php echo isi($data,'day'); ?>"> /
    <input type="text" name="month" size="2" placeholder="MM" value="<?php echo isi($data,'month'); ?>"> /
    <input type="text" name="year" size="4" placeholder="YYYY" value="<?php echo isi($data,'year'); ?>"><br>
    <?php if(isset($error['dob'])) echo $error['dob']."<br>"; ?>
    <br>

    <input type="submit" value="Kirim">
</form>
