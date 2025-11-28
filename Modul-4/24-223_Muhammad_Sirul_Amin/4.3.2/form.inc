<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
  <label>Surname:</label><br>
  <input type="text" name="surname" value="<?php echo isset($surname)?htmlspecialchars($surname):''; ?>"><br>
  <?php if(!empty($errors['surname'])) echo '<small style="color:red;">'.htmlspecialchars($errors['surname']).'</small><br>'; ?>

  <label>Email:</label><br>
  <input type="text" name="email" value="<?php echo isset($email)?htmlspecialchars($email):''; ?>"><br>
  <?php if(!empty($errors['email'])) echo '<small style="color:red;">'.htmlspecialchars($errors['email']).'</small><br>'; ?>

  <label>Age:</label><br>
  <input type="text" name="age" value="<?php echo isset($age)?htmlspecialchars($age):''; ?>"><br>
  <?php if(!empty($errors['age'])) echo '<small style="color:red;">'.htmlspecialchars($errors['age']).'</small><br>'; ?>

  <br><input type="submit" value="Submit">
</form>
