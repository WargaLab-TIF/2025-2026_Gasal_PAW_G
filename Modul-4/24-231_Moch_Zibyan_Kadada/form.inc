<form action="processData_form.php" method="POST">
    <label for="username">Username</label>
    <input type="text" id="username" name="username"
        value="<?= isset($data['username']) ? htmlspecialchars($data['username']) : '' ?>">
    <?php if (isset($errors['username'])): ?><div class="error"><?= $errors['username'] ?></div><?php endif; ?>

    <label for="email">Email address</label>
    <input type="email" id="email" name="email"
        value="<?= isset($data['email']) ? htmlspecialchars($data['email']) : '' ?>">
    <?php if (isset($errors['email'])): ?><div class="error"><?= $errors['email'] ?></div><?php endif; ?>

    <label for="password">Password</label>
    <input type="password" id="password" name="password"
        value="<?= isset($data['password']) ? htmlspecialchars($data['password']) : '' ?>">
    <?php if (isset($errors['password'])): ?><div class="error"><?= $errors['password'] ?></div><?php endif; ?>

    <label for="address">Alamat</label>
    <textarea id="address" name="address"><?= isset($data['address']) ? htmlspecialchars($data['address']) : '' ?></textarea>
    <?php if (isset($errors['address'])): ?><div class="error"><?= $errors['address'] ?></div><?php endif; ?>

    <label for="state">Semester</label>
    <select id="state" name="state">
        <option value="">-- Pilih --</option>
        <option value="1" <?= (isset($data['state']) && $data['state'] == '1') ? 'selected' : '' ?>>1</option>
        <option value="2" <?= (isset($data['state']) && $data['state'] == '2') ? 'selected' : '' ?>>2</option>
        <option value="3" <?= (isset($data['state']) && $data['state'] == '3') ? 'selected' : '' ?>>3</option>
        <option value="4" <?= (isset($data['state']) && $data['state'] == '4') ? 'selected' : '' ?>>4</option>
    </select>
    <?php if (isset($errors['state'])): ?><div class="error"><?= $errors['state'] ?></div><?php endif; ?>

    <input type="hidden" name="country" value="Indonesia">

    <label>Gender</label>
    <div class="gender">
        <input type="radio" id="male" name="gender" value="Laki-laki" <?= (isset($data['gender']) && $data['gender'] == 'Laki-laki') ? 'checked' : '' ?>> Laki-laki
        <input type="radio" id="female" name="gender" value="Perempuan" <?= (isset($data['gender']) && $data['gender'] == 'Perempuan') ? 'checked' : '' ?>> Perempuan
    </div>
    <?php if (isset($errors['gender'])): ?><div class="error"><?= $errors['gender'] ?></div><?php endif; ?>

    <label>Hobi</label>
    <div class="hobi">
        <input type="checkbox" id="futsal" name="hobi[]" value="Futsal" <?= (isset($data['hobi']) && in_array('Futsal', $data['hobi'])) ? 'checked' : '' ?>> Futsal
        <input type="checkbox" id="basket" name="hobi[]" value="Basket" <?= (isset($data['hobi']) && in_array('Basket', $data['hobi'])) ? 'checked' : '' ?>> Basket
    </div>
    <?php if (isset($errors['hobi'])): ?><div class="error"><?= $errors['hobi'] ?></div><?php endif; ?>

    <!-- Tambahan field untuk Age (Type testing) -->
    <label for="age">Umur</label>
    <input type="text" id="age" name="age"
        value="<?= isset($data['age']) ? htmlspecialchars($data['age']) : '' ?>">
    <?php if (isset($errors['age'])): ?><div class="error"><?= $errors['age'] ?></div><?php endif; ?>

    <!-- Tambahan field untuk Birthdate (Date) -->
    <label for="birthdate">Tanggal Lahir</label>
    <input type="text" id="birthdate" name="birthdate"
        value="<?= isset($data['birthdate']) ? htmlspecialchars($data['birthdate']) : '' ?>">
    <?php if (isset($errors['birthdate'])): ?><div class="error"><?= $errors['birthdate'] ?></div><?php endif; ?>

    <input type="submit" value="Submit">
</form>
