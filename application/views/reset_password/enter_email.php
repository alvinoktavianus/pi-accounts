<!DOCTYPE html>
<html>
<head>
    <title>Reset Your Password | PRO Importir</title>
</head>
<body>

<?php echo form_open(base_url('reset_password/submit')); ?>
<input type="email" name="current-email" required placeholder="Please enter your current email">
<input type="submit" value="Submit">
<?php echo form_close(); ?>

</body>
</html>