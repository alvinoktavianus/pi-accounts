<!DOCTYPE html>
<html>
<head>
    <title>Warning | PRO Importir</title>
</head>
<body>

<h1>Warning!</h1>
<p>A valid is credentials is required to do this operation</p>

<?php echo form_open(base_url("migrate/confirm")); ?>
<?php echo form_input(array('placeholder' => 'Email', 'required' => true, 'type' => 'email', 'name' => 'email')); ?><br/>
<?php echo form_password('password', '', array('placeholder' => 'Password', 'required' => true)); ?><br/>
<?php echo form_password('authcode', '', array('placeholder' => 'Authorization code', 'required' => true, 'maxlength' => 4)); ?><br/>
<?php echo form_submit('', 'Authorize'); ?>
<?php echo form_close(); ?>

</body>
</html>