<form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
    <table border="1" cellpadding="5" cellspacing="0">
        <tr>
            <td>First Name</td>
            <td><input type="text" name="firstname" value="<?php echo isset($form_data['firstname']) ? htmlspecialchars($form_data['firstname']) : ''; ?>" /></td>
        </tr>
        <?php if (isset($errors['firstname'])): ?>
        <tr><td colspan="2" style="color: red;"><?php echo $errors['firstname']; ?></td></tr>
        <?php endif; ?>
        
        <tr>
            <td>Surname</td>
            <td><input type="text" name="surname" value="<?php echo isset($form_data['surname']) ? htmlspecialchars($form_data['surname']) : ''; ?>" /></td>
        </tr>
        <?php if (isset($errors['surname'])): ?>
        <tr><td colspan="2" style="color: red;"><?php echo $errors['surname']; ?></td></tr>
        <?php endif; ?>
        
        <tr>
            <td>Email</td>
            <td><input type="text" name="email" value="<?php echo isset($form_data['email']) ? htmlspecialchars($form_data['email']) : ''; ?>" /></td>
        </tr>
        <?php if (isset($errors['email'])): ?>
        <tr><td colspan="2" style="color: red;"><?php echo $errors['email']; ?></td></tr>
        <?php endif; ?>
        
        <tr>
            <td>Phone Number</td>
            <td><input type="text" name="phone" value="<?php echo isset($form_data['phone']) ? htmlspecialchars($form_data['phone']) : ''; ?>" /></td>
        </tr>
        <?php if (isset($errors['phone'])): ?>
        <tr><td colspan="2" style="color: red;"><?php echo $errors['phone']; ?></td></tr>
        <?php endif; ?>
        
        <tr>
            <td>Website URL</td>
            <td><input type="text" name="url" value="<?php echo isset($form_data['url']) ? htmlspecialchars($form_data['url']) : ''; ?>" /></td>
        </tr>
        <?php if (isset($errors['url'])): ?>
        <tr><td colspan="2" style="color: red;"><?php echo $errors['url']; ?></td></tr>
        <?php endif; ?>
        
        <tr>
            <td colspan="2">
                <input type="submit" name="submit" value="Submit" />
            </td>
        </tr>
    </table>
</form>
