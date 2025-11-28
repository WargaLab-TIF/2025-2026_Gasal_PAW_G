<form action="index.php" method="POST">
  <label for="surname">Surname: </label>
  <input type="text" name="surname" id="surname" value="<?= $surname ?? "" ?>">
  <br>
  <label for="email">Email: </label>
  <input type="text" name="email" id="email" value="<?= $email ?? "" ?>">
  <br>
  <label for="age">Age: </label>
  <input type="text" name="age" id="age" value="<?= $age ?? "" ?>">
  <br>
  <label for="website">Website: </label>
  <input type="text" name="website" id="website" value="<?= $website ?? "" ?>">
  <br>
  <button type="submit" name="submit">Submit</button>
</form>
