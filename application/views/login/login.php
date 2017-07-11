<?php echo form_open(base_url('login/do_login'), array('name' => 'loginForm', 'novalidate' => 'true')); ?>

    <div class="form-group" ng-class="{ 'has-error' : loginForm.email.$invalid && !loginForm.email.$pristine, 'has-success': loginForm.email.$valid }">
        <?php echo form_label('Email', 'email', array('class' => 'sr-only')); ?>
        <?php echo form_input(array('type' => 'email', 'class' => 'form-control', 'id' => 'email', 'name' => 'email', 'ng-required' => true, 'ng-model' => 'login.email', 'placeholder' => 'Email', 'ng-pattern' => '/^[a-z]+[a-z0-9._]+@[a-z]+\.[a-z.]{2,5}$/')); ?>
        <span ng-show="!loginForm.email.$pristine && (loginForm.email.$error.required || loginForm.email.$error.pattern)" class="help-block" ng-cloak>Please enter your email address</span>
    </div>

    <div class="form-group" ng-class="{ 'has-error' : loginForm.password.$invalid && !loginForm.password.$pristine, 'has-success': loginForm.password.$valid }">
        <?php echo form_label('Password', 'password', array('class' => 'sr-only')); ?>
        <?php echo form_password('password', '', array('class' => 'form-control', 'name' => 'password', 'ng-model' => 'login.password', 'ng-required' => true, 'placeholder' => 'Password', 'ng-minlength' => 6)); ?>
        <span ng-show="!loginForm.password.$pristine && (loginForm.password.$error.required || loginForm.password.$error.minlength)" class="help-block" ng-cloak>Please enter your password</span>
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-default" ng-disabled="loginForm.$invalid">Log In</button>
    </div>

<?php echo form_close(); ?>