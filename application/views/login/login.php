<?php if ($this->session->flashdata('success')): ?>
    <div class="alert alert-success" role="alert">
        <strong><?php echo $this->session->flashdata('success'); ?></strong>
    </div>
<?php endif; ?>

<?php if ($this->session->flashdata('errors')): ?>
    <div class="alert alert-danger" role="alert">
        <strong><?php echo $this->session->flashdata('errors'); ?></strong>
    </div>
<?php endif; ?>

<div class="logindiv">
    <?php echo form_open(base_url('login/do_login'), array('name' => 'loginForm', 'novalidate' => 'true', 'class' => 'loginformcss')); ?>

    <div class="group">
        <div class="form-group" ng-class="{ 'has-error' : loginForm.email.$invalid && !loginForm.email.$pristine, 'has-success': loginForm.email.$valid }">
            <?php echo form_input(array('type' => 'email', 'id' => 'email', 'name' => 'email', 'ng-required' => true, 'ng-model' => 'login.email', 'ng-pattern' => '/^[a-z]+[a-z0-9._]+@[a-z]+\.[a-z.]{2,5}$/')); ?>
            <span class="highlight"></span><span class="bar"></span>
            <label>Email</label>
            <span ng-show="!loginForm.email.$pristine && (loginForm.email.$error.required || loginForm.email.$error.pattern)" class="help-block" ng-cloak>Please enter your email address</span>
        </div>
    </div>
    
    <div class="group">
        <div class="form-group" ng-class="{ 'has-error' : loginForm.password.$invalid && !loginForm.password.$pristine, 'has-success': loginForm.password.$valid }">
            <?php echo form_password('password', '', array('name' => 'password', 'ng-model' => 'login.password', 'ng-required' => true, 'ng-minlength' => 6)); ?>
            <span class="highlight"></span><span class="bar"></span>
           <label>Password</label>
            <span ng-show="!loginForm.password.$pristine && (loginForm.password.$error.required || loginForm.password.$error.minlength)" class="help-block" ng-cloak>Please enter your password</span>
        </div>
    </div>

    <button type="submit" class="button buttonBlue" ng-disabled="loginForm.$invalid" ng-cloak>LOGIN
        <div class="ripples buttonRipples"><span class="ripplesCircle"></span></div>
    </button>
    
    <a href="<?php echo base_url('register'); ?>"><button type="button" class="button buttonGreen" ng-cloak>REGISTER
        <div class="ripples buttonRipples"><span class="ripplesCircle"></span></div>
    </button></a>
</div>

<?php echo form_close(); ?>