<?php
$surname_val = isset($values['surname']) ? htmlspecialchars($values['surname'], ENT_QUOTES, 'UTF-8') : '';
$email_val = isset($values['email']) ? htmlspecialchars($values['email'], ENT_QUOTES, 'UTF-8') : '';
$age_val = isset($values['age']) ? htmlspecialchars($values['age'], ENT_QUOTES, 'UTF-8') : '';
?>
<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
  <label>Surname:</label>
  <input type="text" name="surname" value="<?php echo $surname_val; ?>">
  <?php if (!empty($errors['surname'])): ?><div style="color:red"><?php echo $errors['surname']; ?></div><?php endif; ?>
  <br><br>

  <label>Email:</label>
  <input type="text" name="email" value="<?php echo $email_val; ?>">
  <?php if (!empty($errors['email'])): ?><div style="color:red"><?php echo $errors['email']; ?></div><?php endif; ?>
  <br><br>

  <label>Age:</label>
  <input type="text" name="age" value="<?php echo $age_val; ?>">
  <?php if (!empty($errors['age'])): ?><div style="color:red"><?php echo $errors['age']; ?></div><?php endif; ?>
  <br><br>

  <input type="submit" name="submit" value="Kirim">
</form>
