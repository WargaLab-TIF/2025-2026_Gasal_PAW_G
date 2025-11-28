<form action="index.php" method="POST">
  <label for="surname">Surname: </label>
  <input type="text" name="surname" id="surname" value="<?= $surname ?? "" ?>"/>
  <button type="submit" name="submit">Submit</button>
</form>
