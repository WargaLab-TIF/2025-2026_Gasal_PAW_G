<form action="index.php" method="POST">
  <label for="surname">Surname: </label>
  <input type="text" name="surname" id="surname" value="<?= $surname ?? "" ?>">
  <br>
  <label for="email">Email: </label>
  <input type="text" name="email" id="email" value="<?= $email ?? "" ?>">
  <br>
  <button type="submit" name="submit">Submit</button>
</form>
