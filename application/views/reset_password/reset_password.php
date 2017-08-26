<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
</head>
<body>

<!-- TODO: Update template -->
<?php echo form_open(base_url('reset_password/update').'?reset_token='.$resetToken); ?>
    <input type="password" name="new-password" placeholder="Please enter your new password" required>
    <input type="submit" value="Save">
<?php echo form_close(); ?>

</body>
</html>